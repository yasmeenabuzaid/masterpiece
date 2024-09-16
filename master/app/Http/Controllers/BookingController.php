<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Castomor;
use App\Models\Employee;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        $services = Service::all();
        $castomors = Castomor::all();


        $bookings = Booking::all();
        return view('dashboard/booking/index', ['bookings' => $bookings ,'castomors'=>$castomors,'services'=>$services,'employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   $employees = Employee::all();
        $services = Service::all();
        $castomors = Castomor::all();

        return view('dashboard/booking/create', ['castomors'=>$castomors,'services'=>$services,'employees'=>$employees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            //  dd($request->all());
             $request->validate([
                'name' => 'required|string|max:255',
                'appointment_date' => 'required|date',
                'description' => 'nullable|string',
                'castomors_id' => 'required|exists:castomors,id',
                'employees_id' => 'required|exists:employees,id',
                'services_id' => 'required|exists:services,id',
            ]);
            Booking::create($request->all());

            return redirect()->route('bookings.index')->with('success', 'Subcategory created successfully.');
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
        $employees = Employee::all();
        $services = Service::all();
        $castomors = Castomor::all();

        // Convert appointment_date to Carbon instance if needed
        $booking->appointment_date = Carbon::parse($booking->appointment_date);

        return view('dashboard/booking/edit', [
            'booking' => $booking,
            'castomors' => $castomors,
            'services' => $services,
            'employees' => $employees
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
            'castomors_id' => 'required|exists:castomors,id',
            'employees_id' => 'required|exists:employees,id',
            'services_id' => 'required|exists:services,id',
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

}
