<?php

namespace App\Http\Controllers;
use App\Models\Salon;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Categorie;
use App\Models\Feed;
use App\Models\User;
// App\Http\Controllers\User
use App\Models\SubSalon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

        //
        public function index()
        {
            $feedbacks = Feed::all() ?? [];
            $subsalons = SubSalon::with('bookings')->get();
            $categories = Categorie::all() ?? [];
            $bookings = Booking::all() ?? [];
            $services = Service::all() ?? [];
            $salons = Salon::all() ?? [];

            $superAdminsCount = User::where('usertype', 'super_admin')->count();
            $ownersCount = User::where('usertype', 'owner')->count();
            $employeesCount = User::where('usertype', 'employee')->count();
            $usersCount = User::where('usertype', 'user')->count();

            $subSalonNames = $subsalons->pluck('name');
            $subSalonBookings = $subsalons->map(function ($subSalon) {
                return $subSalon->bookings->count();
            });

            return view('dashboard.index', [
                'salons' => $salons,
                'feedbacks' => $feedbacks,
                'subsalons' => $subsalons,
                'categories' => $categories,
                'bookings' => $bookings,
                'services' => $services,
                'superAdminsCount' => $superAdminsCount,
                'ownersCount' => $ownersCount,
                'employeesCount' => $employeesCount,
                'usersCount' => $usersCount,
                'subSalonBookings' => $subSalonBookings,
                'subSalonNames' => $subSalonNames,
            ]);
        }
        }











