<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\SubSalon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::all();
        $users = User::all();
        return view('dashboard.booking.index', ['bookings' => $bookings, 'users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $subsalons = SubSalon::all();

        return view('dashboard.booking.create', [
            'users' => $users,
            'subsalons' => $subsalons
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
            'user_id' => 'required|exists:users,id',
            'sub_salons_id' => 'required|exists:sub_salons,id', // Make SubSalon required
        ]);

        Booking::create($request->only(['name', 'description', 'user_id', 'appointment_date', 'sub_salons_id']));

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('dashboard.booking.view', ['booking' => $booking]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $booking->appointment_date = Carbon::parse($booking->appointment_date);
        $users = User::all();
        $subsalons = SubSalon::all(); // Fetch SubSalons for the edit view

        return view('dashboard.booking.edit', [
            'booking' => $booking,
            'users' => $users,
            'subsalons' => $subsalons // Pass SubSalons to the view
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
            'user_id' => 'required|exists:users,id',
            'sub_salons_id' => 'required|exists:sub_salons,id',
        ]);

        $booking->update($request->only(['name', 'description', 'user_id', 'appointment_date', 'sub_salons_id']));

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
