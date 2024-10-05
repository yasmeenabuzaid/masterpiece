<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Models\User; // تأكد من استيراد نموذج المستخدم
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        $bookings = Booking::all();

        return view('dashboard.booking.index', ['bookings' => $bookings, 'services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all();
        // جلب المستخدمين من النوع employee
        $employees = User::where('usertype', 'employee')->get();
        // جلب المستخدمين من النوع user
        $customers = User::where('usertype', 'user')->get();

        return view('dashboard.booking.create', [
            'services' => $services,
            'employees' => $employees,
            'customers' => $customers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'description' => 'nullable|string',
            'services_id' => 'required|exists:services,id',
            'user_id' => 'required|exists:users,id', // تأكد من تطابق هذا الاسم
        ]);

        Booking::create($request->only(['name', 'description', 'user_id', 'services_id', 'appointment_date']));

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $services = Service::all();
        // Convert appointment_date to Carbon instance if needed
        $booking->appointment_date = Carbon::parse($booking->appointment_date);

        return view('dashboard.booking.edit', [
            'booking' => $booking,
            'services' => $services,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'description' => 'nullable|string',
            'services_id' => 'required|exists:services,id',
            'user_id' => 'required|exists:users,id',
            'usertype' => 'required|in:employee,user', // Validate usertype
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
