<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Testimonial;
use App\Models\User;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $testimonials = Testimonial::all();
        $user = Auth::user();

        return view('home', ['testimonials' => $testimonials, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $testimonials = Testimonial::all();
        $user = Auth::user();

        return view('home', ['testimonials' => $testimonials, 'user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'testimonial' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        Testimonial::create([
            'testimonial' => $request->testimonial,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Testimonial submitted successfully!');
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
