<?php

namespace App\Http\Controllers;
use App\Models\Owner;
use App\Models\Salon;
use App\Models\Castomor;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\Feed;
use App\Models\Subcat;
use App\Models\SubSalon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $feedbacks = Feed::all();
        $subcategories = Subcat::all();
        $subsalons = SubSalon::all();
        $categories = Categorie::all();
        $castomors = Castomor::all();
        $bookings = Booking::all();
        $employees = Employee::all();
        $services = Service::all();
        $salons = Salon::all();
        $owners = Owner::all();

        //$data
        return view('dashboard\index',[

            'salons'=>$salons,
            'feedbacks'=>$feedbacks,
            'subcategories'=>$subcategories,
            'subsalons'=>$subsalons,
            'categories'=>$categories,
            'castomors'=>$castomors,
            'bookings'=>$bookings,
            'employees'=>$employees,
            'services'=>$services,
            'owners'=>$owners,
        ]);
    }

}
