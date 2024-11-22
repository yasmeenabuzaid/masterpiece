<?php
namespace App\Http\Controllers;
use App\Models\Booking;
use App\Models\BookingService;
use App\Models\SubSalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class BookingController extends Controller
{
    // ---------------------------------------------------------- view in dashbourd --------------------------------------------------
    public function index()
    {

        $user = Auth::user();

        if ($user->isSuperAdmin()) {
            $bookings = Booking::with('services')->get(); // scope operator (::)
        }
        elseif ($user->isOwner()) {
            $bookings = Booking::whereHas('subSalon.salon', function ($query) use ($user) {
                 // wherehas to get data from relationship ( booking in salon and sub salons)
                $query->where('user_id', $user->id);
            })->with('services')->get();
        }
        elseif ($user->isEmployee()) {
            // Refund employee bookings with associated services
            $bookings = Booking::where('user_id', $user->id)->with('services')->get();
        }
        else {
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

        $employeesCount = $subSalon->usersCount();

        $bookedTimes = Booking::where('date', $date)
            ->pluck('time')->toArray();  // استخراج الأوقات المحجوزة

        $timeCounts = Booking::where('date', $date)
            ->groupBy('time')
            ->selectRaw('time, count(*) as bookings_count')
            ->pluck('bookings_count', 'time')->toArray(); // عدد الحجوزات لكل وقت

        $availableTimes = [];

        // المرور عبر جميع الأوقات المتاحة
        for ($time = $openingStart->copy(); $time->lte($openingEnd); $time->addMinutes(15)) {
            $timeString = $time->format('H:i');

            // عدد الحجوزات الحالية لهذا الوقت
            $currentBookings = isset($timeCounts[$timeString]) ? $timeCounts[$timeString] : 0;

            // إذا كانت الحجز لهذا الوقت أقل من عدد الموظفين، أضف الوقت كمتاح
            if (!in_array($timeString, $bookedTimes) && $currentBookings < $employeesCount) {
                $availableTimes[] = $timeString;
            }
        }

        return response()->json($availableTimes);
    }



    public function store(Request $request)
    {
        if (!auth()->check()) {
            // session(['from_productFeedback' => true, 'product_id' => $request->input('product_id')]);

            return redirect()->route('login')->with('error', 'Please log in to submit your review.');
        }
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'note' => 'nullable|string',
            'services' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            // تحقق من عدد الحجوزات في الوقت المحدد
            $subSalon = SubSalon::findOrFail($request->sub_salons_id);
            $employeesCount = $subSalon->usersCount();  // عدد الموظفين
            $bookedTimes = Booking::where('date', $request->date)
                ->where('time', $request->time)
                ->count();

            // إذا كان العدد المحجوز أكبر من أو يساوي عدد الموظفين، فلا يمكن إتمام الحجز
            if ($bookedTimes >= $employeesCount) {
                session()->flash('error', 'The selected time is fully booked.');
                return redirect()->back();
            }

            // إذا كان الوقت متاحًا، أكمل الحجز
            $booking = new Booking();
            $booking->sub_salons_id = $request->sub_salons_id ?? null;
            $booking->user_id = auth()->id();
            $booking->date = $request->date;
            $booking->time = $request->time;
            $booking->note = $request->note;
            $booking->save();

            $serviceIds = explode(',', $request->services);  // تحويل السلسلة إلى مصفوفة

            $bookingServices = [];
            foreach ($serviceIds as $serviceId) {
                $bookingServices[] = [
                    'booking_id' => $booking->id,
                    'service_id' => $serviceId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            BookingService::insert($bookingServices);

            DB::commit();

            session()->flash('success', 'Booking completed successfully!');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error saving booking: " . $e->getMessage());
            session()->flash('error', 'An error occurred during booking. Please try again.');
            return redirect()->back();
        }
    }




    public function get(Request $request)
    {
        // التأكد من أن المستخدم مسجل دخول
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // استرجاع جميع الحجوزات للمستخدم مع الصالون الفرعي المرتبط
        $userBookings = Booking::where('user_id', Auth::id())
        ->with('subSalon')  // جلب الصالون الفرعي المرتبط
        ->get();


        // تفقد الحجوزات المسترجعة
        // dd($userBookings); // هذه السطر سيتوقف ويعرض البيانات

        // تمرير الحجوزات إلى العرض
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

        return redirect()->route(route: 'bookings.index')->with('success', 'Booking successfully deleted.');
    }
}
