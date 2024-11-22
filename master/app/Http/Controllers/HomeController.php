<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use App\Models\SubSalon;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Booking;
use App\Models\BookingService;
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
        $userCount = User::count();

        $salonCount = Salon::count();
        $allSubsalons = SubSalon::all();
        $usersCount = User::where('usertype', 'user')->count();

        $bookingCount = Booking::count();
        $subsalonCount = SubSalon::count();
        $subsalons =SubSalon::all();
        $salons =Salon::all();
        $users =User::all();
        $ownersCount = User::where('usertype', 'owner')->count();

        $bookings =Booking::all();
        $bookingServices  =BookingService::all();
        return view('user_side\landing ',['salons'=>$salons  ,'subsalons'=>$subsalons ,'users'=>$users ,'bookings'=>$bookings,'allSubsalons'=>$allSubsalons,'bookingCount'=>$bookingCount,'userCount'=>$userCount,'salonCount'=>$salonCount ,'subsalonCount'=>$subsalonCount ,'usersCount'=>$usersCount ,'ownersCount'=>$ownersCount]);
    }
    public function show()
    {
        $userCount = User::count();

        $salonCount = Salon::count();
        $subsalonCount = SubSalon::count();
        $allSubsalons = SubSalon::all();

        $bookingCount = Booking::count();
        $subsalons =SubSalon::all();
        $salons =Salon::all();
        $users =User::all();
        $bookings =Booking::all();
        $bookingServices  =BookingService::all();
        return view('user_side\about ',['salons'=>$salons ,'subsalons'=>$subsalons ,'users'=>$users ,'bookings'=>$bookings,'allSubsalons'=>$allSubsalons,'bookingCount'=>$bookingCount,'userCount'=>$userCount,'salonCount'=>$salonCount ,'subsalonCount'=>$subsalonCount]);
    }
}
