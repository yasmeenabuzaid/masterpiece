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

        $date = $request->get('date');  // this date us selected from user

        $employeesCount = $subSalon->usersCount();

        $bookedTimes = Booking::where('date', $date)
            ->pluck('time')->toArray();  // time to arry

        $timeCounts = Booking::where('date', $date)
            ->groupBy('time')
            ->selectRaw('time, count(*) as bookings_count')
            ->pluck('bookings_count', 'time')->toArray(); // count of booking whth his time

        $availableTimes = [];

        for ($time = $openingStart->copy(); $time->lte($openingEnd); $time->addMinutes(15)) {
            $timeString = $time->format('H:i');

            $currentBookings = isset($timeCounts[$timeString]) ? $timeCounts[$timeString] : 0;
            if (!in_array($timeString, $bookedTimes) && $currentBookings < $employeesCount) {
                $availableTimes[] = $timeString;
            }
        }

        return response()->json($availableTimes);
    }




    public function store(Request $request)
    {

        // dd($request);

        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'note' => 'nullable|string',
            'services' => 'required|string',
        ]);

        try {
            DB::beginTransaction();
            //booking is done -> store
            //booking is  not done ->catch-> roll back changes and not save

            $booking = new Booking();
            $booking->sub_salons_id = $request->sub_salons_id ?? null;
            $booking->user_id = auth()->id();
            $booking->date = $request->date;
            $booking->time = $request->time;
            $booking->note = $request->note;
            $booking->save();

            $serviceIds = explode(',', $request->services); // to tern string to array  -> 1,2 -> [1,2]

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

            DB::commit(); // to save changes to database

            session()->flash('success', 'Booking completed successfully!');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollBack(); //  to roll back changes

            Log::error("Error saving booking: " . $e->getMessage()); //to log error message in laravel

            session()->flash('error', 'An error occurred during booking. Please try again.');
            return redirect()->back();
        }
    }



    public function get(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'please login first');
        }

        $query = Booking::where('user_id', Auth::id())->with('subSalon');



        if ($request->has('salon_name') && $request->salon_name != '') {
            $query->whereHas('subSalon.salon', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->salon_name . '%');
            });
        }

        $userBookings = Booking::where('user_id', auth()->id())
        ->where('time', '>', now())
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
