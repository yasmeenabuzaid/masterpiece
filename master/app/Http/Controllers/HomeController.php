<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use App\Models\SubSalon;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        $testimonial=Testimonial::all();
        $subsalons =SubSalon::all();
        $salons =Salon::all();
        return view('user_side\landing ',['salons'=>$salons ,'testimonial'=>$testimonial ,'subsalons'=>$subsalons]);
    }
}
