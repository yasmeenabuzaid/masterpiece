<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\SubSalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $bookings = Booking::all();
        } elseif ($user->isOwner()) {
            $bookings = Booking::whereHas('subSalon.salon', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        } elseif ($user->isEmployee()) {
            $bookings = Booking::where('user_id', $user->id)->get();
        } else {
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        return view('dashboard.booking.index', compact('bookings'));
    }

    public function showAvailableTimes(Request $request, $subSalonId)
    {
        $subSalon = SubSalon::findOrFail($subSalonId);
        $openingStart = \Carbon\Carbon::createFromFormat('H:i:s', $subSalon->opening_hours_start);
        $openingEnd = \Carbon\Carbon::createFromFormat('H:i:s', $subSalon->opening_hours_end);

        $date = $request->get('date');
        $bookedTimes = Booking::where('date', $date)
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



    public function store(Request $request)
    {
        // عرض محتوى الـ request في حالة التصحيح
        // dd($request);

        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'note' => 'nullable|string',
            'services' => 'required|string', // التحقق من أن حقل الخدمات ليس فارغًا
        ]);

        // محاولة تنفيذ الحجز ضمن معاملة
        try {
            DB::beginTransaction();

            // إنشاء حجز جديد
            $booking = new Booking();
            $booking->sub_salons_id = $request->sub_salons_id ?? null; // تأكد من تعيين sub_salons_id إذا كان متاحًا
            $booking->user_id = auth()->id(); // تعيين معرف المستخدم الحالي
            $booking->date = $request->date;  // تعيين التاريخ
            $booking->time = $request->time;  // تعيين الوقت
            $booking->note = $request->note;  // تعيين الملاحظة
            $booking->save();  // حفظ الحجز

            // تقسيم قيم الخدمات إلى مصفوفة
            $serviceIds = explode(',', $request->services);  // تحويل السلسلة إلى مصفوفة

            // تحضير بيانات الخدمات
            $bookingServices = [];
            foreach ($serviceIds as $serviceId) {
                $bookingServices[] = [
                    'booking_id' => $booking->id,  // ربط الخدمة بالحجز
                    'service_id' => $serviceId,    // معرف الخدمة
                    'created_at' => now(),         // وقت الإنشاء
                    'updated_at' => now(),         // وقت التحديث
                ];
            }

            // إدخال البيانات في جدول `BookingService`
            BookingService::insert($bookingServices);

            // تأكيد المعاملة
            DB::commit();

            // إظهار رسالة نجاح
            session()->flash('success', 'Booking completed successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            // إلغاء المعاملة في حالة حدوث خطأ
            DB::rollBack();

            // تسجيل الخطأ في السجلات
            Log::error("Error saving booking: " . $e->getMessage());

            // إظهار رسالة خطأ للمستخدم
            session()->flash('error', 'An error occurred during booking. Please try again.');
            return redirect()->back();
        }
    }



    public function get(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول لعرض حجوزاتك.');
        }

        $query = Booking::where('user_id', Auth::id())->with('subSalon');

        if ($request->has('order_by') && in_array($request->order_by, ['oldest', 'newest'])) {
            if ($request->order_by == 'newest') {
                $query->orderBy('date', 'desc')->orderBy('time', 'desc');
            } else {
                $query->orderBy('date', 'asc')->orderBy('time', 'asc');
            }
        }

        if ($request->has('salon_name') && $request->salon_name != '') {
            $query->whereHas('subSalon.salon', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->salon_name . '%');
            });
        }

        $userBookings = Booking::where('user_id', auth()->id())
        ->where('time', '>', now())  // الحجز الذي لم ينتهِ بعد
        ->get();

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
