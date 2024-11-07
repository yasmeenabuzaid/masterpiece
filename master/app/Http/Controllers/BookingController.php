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


 public function store(Request $request)
 {
     $request->validate([
    //     'services' => 'required|array',
    // 'services.*' => 'exists:services,id',
         'date' => 'required|date',
         'time' => 'required|date_format:H:i',
         'note' => 'nullable',
        ]);


     try {
         $booking = new Booking();
         $booking->sub_salons_id = $request->sub_salons_id;
         $booking->user_id = auth()->id();  // Assuming the user is authenticated
         $booking->date = $request->date;  // Store the selected date
         $booking->time = $request->time;  // Store the selected time
         $booking->note = $request->note;  // Store any special notes
         $booking->save();  // Save the booking to the database

         $bookingServices = [];
         foreach ($request->services as $serviceId) {
             $bookingServices[] = [
                 'booking_id' => $booking->id,
                 'service_id' => $serviceId,

             ];
         }
         BookingService::insert($bookingServices);


         return redirect()->route('booking.success')->with('message', 'Booking successful!');
     } catch (\Exception $e) {
         DB::rollBack();
         Log::error("Error saving booking: " . $e->getMessage());
         return redirect()->back()->withErrors(['error' => 'Failed to save booking. Please try again.']);
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

public function get()
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول لعرض حجوزاتك.');
    }

    $userBookings = Booking::where('user_id', Auth::id())->with('subSalon')->get();


        return view('user_side.confirmation', compact('userBookings'));
    }


}
