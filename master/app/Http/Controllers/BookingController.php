<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\SubSalon;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class BookingController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            // إذا كان المستخدم SuperAdmin، جلب جميع الحجوزات
            $bookings = Booking::all();
        } elseif ($user->isOwner()) {
            // إذا كان المستخدم هو Owner، جلب الحجوزات المرتبطة بالـ SubSalon عبر الـ Salon
            $bookings = Booking::whereHas('subalon.salon', function ($query) use ($user) {
                // التأكد من أن الـ Salon مرتبط بالـ Owner عبر الـ user_id
                $query->where('user_id', $user->id);
            })->get();
        } elseif ($user->isEmployee()) {
            // إذا كان المستخدم Employee، جلب الحجوزات الخاصة به
            $bookings = Booking::where('user_id', $user->id)->get();
        } else {
            // إذا لم يكن المستخدم مسجل دخوله
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        // إرجاع الحجوزات إلى العرض
        return view('dashboard.booking.index', compact('bookings'));
    }



    public function showServices($subsalonId) // تأكد من إضافة المعرف كوسيلة إدخال
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول قبل رؤية الخدمات.');
        }

        // جلب الـ SubSalon مع عدد المستخدمين
        $subsalon = SubSalon::withCount('users')->findOrFail($subsalonId);

        // احصل على جميع الخدمات الخاصة بالصالون الفرعي
        $services = Service::where('sub_salons_id', $subsalon->id)->get();
        $bookings = Booking::all();

        // تحقق إذا كان الـ SubSalon موجودًا
        if (!$subsalon) {
            return redirect()->back()->with('error', 'No sub-salon found.');
        }

        // احصل على الأوقات المتاحة بناءً على ساعات العمل
        $availableTimes = Time::where('time', '>=', $subsalon->opening_hours_start)
            ->where('time', '<=', $subsalon->opening_hours_end)
            ->pluck('time');

        return view('user_side.categories', compact('services', 'bookings', 'subsalon', 'availableTimes'));
    }


    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'note' => 'nullable',
        ]);



        try {
            // إنشاء حجز جديد
            $booking = new Booking();
            $booking->sub_salons_id = $request->sub_salons_id;
            $booking->user_id = auth()->id();  // بافتراض أن المستخدم مسجل الدخول
            $booking->date = $request->date;   // تخزين التاريخ المختار
            $booking->time = $request->time;   // تخزين الوقت المختار
            $booking->note = $request->note;   // تخزين أي ملاحظات خاصة
            $booking->save();  // حفظ الحجز في قاعدة البيانات

            // تحويل `services` إلى مصفوفة
            $serviceIds = explode(',', $request->services);  // تحويل السلسلة إلى مصفوفة

            // إعداد بيانات الخدمات المتعلقة بالحجز
            $bookingServices = [];
            foreach ($serviceIds as $serviceId) {
                $bookingServices[] = [
                    'booking_id' => $booking->id,
                    'service_id' => $serviceId,
                    'created_at' => now(),  // إضافة وقت الإنشاء
                    'updated_at' => now(),  // إضافة وقت التحديث
                ];
            }

            // إدخال بيانات الخدمات المتعلقة بالحجز دفعة واحدة
            BookingService::insert($bookingServices);

         // After successfully completing the booking
session()->flash('success', 'Booking completed successfully!');
return redirect()->back();

           } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error saving booking: " . $e->getMessage());
            session()->flash('error', 'An error occurred during booking. Please try again.');
            return redirect()->back();
                    }
    }







    public function showAvailableTimes($subSalonId, Request $request)
    {
        $subSalon = SubSalon::findOrFail($subSalonId);
        $openingStart = \Carbon\Carbon::createFromFormat('H:i:s', $subSalon->opening_hours_start);
        $openingEnd = \Carbon\Carbon::createFromFormat('H:i:s', $subSalon->opening_hours_end);

        $bookedTimes = Booking::where('date', $request->query('date'))
            ->pluck('time')->toArray();

        $availableTimes = [];
        for ($time = $openingStart->copy(); $time->lte($openingEnd); $time->addMinutes(15)) {
            $timeString = $time->format('H:i');
            if (!in_array($timeString, $bookedTimes)) {
                $availableTimes[] = $timeString;
            }
        }

        return response()->json($availableTimes);
    }

    public function get(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول لعرض حجوزاتك.');
        }

        $query = Booking::where('user_id', Auth::id())->with('subalon');

        if ($request->has('order_by') && in_array($request->order_by, ['oldest', 'newest'])) {
            if ($request->order_by == 'newest') {
                $query->orderBy('date', 'desc')->orderBy('time', 'desc');
            } else {
                $query->orderBy('date', 'asc')->orderBy('time', 'asc');
            }
        }

        if ($request->has('salon_name') && $request->salon_name != '') {
            $query->whereHas('subalon.salon', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->salon_name . '%');
            });
        }

        $userBookings = $query->get();

        return view('user_side.user_profile.my_booking', compact('userBookings'));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        $user = auth()->user();

        if (!$user->isSuperAdmin() && !$user->isOwner()) {
            return redirect()->route('bookings.index')->with('error', 'You do not have permission to delete this booking.');
        }

        $booking->services()->delete();

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking successfully deleted.');
    }




}
