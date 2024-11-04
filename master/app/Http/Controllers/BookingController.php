<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\SubSalon;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class BookingController extends Controller
{

    public function index()
    {
        // تحقق مما إذا كان المستخدم هو سوبر أدمين
        if (!Auth::check() || !Auth::user()->isSuperAdmin()) {
            return redirect()->route('home')->with('error', 'ليس لديك صلاحية للوصول إلى هذه الصفحة.');
        }

        // جلب جميع الحجوزات
        $bookings = Booking::with('subSalon', 'customer')->get(); // تأكد من إضافة العلاقات المناسبة

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
        $services = Service::where('sub_salon_id', $subsalon->id)->get();
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


 // في BookingController
 public function store(Request $request)
 {
     // احصل على الصالون الفرعي المرتبط بالحجز باستخدام sub_salon_id من الطلب
     $subSalon = SubSalon::find($request->sub_salon_id);

     // تحقق مما إذا كان sub_salon موجودًا
     if (!$subSalon) {
         return redirect()->back()->withErrors(['sub_salon_id' => 'The selected salon does not exist.']);
     }

     // تحقق من عدد المستخدمين المرتبطين بالصالون
     $maxBookingsPerHour = $subSalon->usersCount();

     // احسب عدد الحجوزات الحالية في الساعة المطلوبة
     $currentBookingsAtHour = Booking::where('sub_salon_id', $subSalon->id)
         ->where('booking_time', $request->booking_time)
         ->count();

     // تحقق من توافر الحجوزات
     if ($currentBookingsAtHour >= $maxBookingsPerHour) {
         return redirect()->back()->withErrors(['booking_time' => 'This time slot is fully booked. Please choose another time.']);
     }

     // أكمل عملية الحجز إذا كانت الساعة متاحة
     $booking = new Booking();
     $booking->sub_salon_id = $request->sub_salon_id;
     $booking->booking_time = $request->booking_time;
     $booking->customer_id = auth()->id();
     $booking->save();

     return redirect()->route('booking.success')->with('message', 'Booking successful!');
 }



    public function showAvailableTimes($subSalonId, Request $request)
    {
        $subSalon = SubSalon::findOrFail($subSalonId);
        $openingStart = \Carbon\Carbon::createFromFormat('H:i:s', $subSalon->opening_hours_start);
        $openingEnd = \Carbon\Carbon::createFromFormat('H:i:s', $subSalon->opening_hours_end);

        // Retrieve the booked times on the selected date
        $bookedTimes = Booking::where('date', $request->query('date'))
            ->pluck('time')->toArray();

        // Generate all possible times within opening hours in 15-minute intervals (adjust as necessary)
        $availableTimes = [];
        for ($time = $openingStart->copy(); $time->lte($openingEnd); $time->addMinutes(15)) {
            $timeString = $time->format('H:i');
            if (!in_array($timeString, $bookedTimes)) {
                $availableTimes[] = $timeString;
            }
        }

        return response()->json($availableTimes);
    }



}
