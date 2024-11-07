<?php

namespace App\Http\Controllers;

use App\Models\BookingService;
use Illuminate\Http\Request;

class BookingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'booking_id' => 'required|exists:bookings,id',
        //     'service_id' => 'required|exists:services,id',
        // ]);

        // $bookingServices = [];
        // foreach ($request->services as $serviceId) {
        //     $bookingServices[] = [
        //         'booking_id' => $request->booking_id,
        //         'service_id' => $serviceId,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // BookingService::insert($bookingServices); // Efficiently insert multiple services

        // return redirect()->route('booking_services.index')->with('success', 'Service(s) added successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(BookingService $bookingService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookingService $bookingService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookingService $bookingService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BookingService $bookingService)
    {
        //
    }
}
