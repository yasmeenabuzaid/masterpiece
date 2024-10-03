<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\Salon;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salons = Salon::all();

        $testimonials = Testimonial::all();
        return view('welcome',['salons'=>$salons ,'testimonials'=>$testimonials]);
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
        dd($request);
        $validatedData = $request->validate([
            'testimonial' => 'required|string|max:255',
            'user_id' => 'required|integer', // Changed to integer for user ID
            'sub_salons_id' => 'required|integer', // Fixed whitespace and changed to integer
        ]);

        $testimonial = new Testimonial();
        $testimonial->testimonial = $validatedData['testimonial'];
        $testimonial->user_id = $validatedData['user_id'];
        $testimonial->sub_salons_id = $validatedData['sub_salons_id'];
        $testimonial->save();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.'); // Updated success message
    }
    /**
     * Display the specified resource.
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        //
    }
}
