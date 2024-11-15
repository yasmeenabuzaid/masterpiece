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
        $subsalons = SubSalon::with('bookings')->get();  // تحميل الحجزات لكل SubSalon
        $categories = Categorie::all() ?? [];
        $customers = Castomor::all() ?? [];
        $bookings = Booking::all() ?? [];
        $employees = Employee::all() ?? [];
        $services = Service::all() ?? [];
        $salons = Salon::all() ?? [];
        $owners = Owner::all() ?? [];

        // إحصائيات المستخدمين
        $superAdminsCount = User::where('usertype', 'super_admin')->count();
        $ownersCount = User::where('usertype', 'owner')->count();
        $employeesCount = User::where('usertype', 'employee')->count();
        $usersCount = User::where('usertype', 'user')->count();

        // حساب عدد الحجزات لكل Sub Salon
        $subSalonNames = $subsalons->pluck('name');  // الحصول على أسماء الصالونات الفرعية
        $subSalonBookings = $subsalons->map(function ($subSalon) {
            return $subSalon->bookings->count();  // عدد الحجزات لكل SubSalon
        });

        return view('dashboard.index', [
            'salons' => $salons,
            'feedbacks' => $feedbacks,
            'subsalons' => $subsalons,
            'categories' => $categories,
            'customers' => $customers,
            'bookings' => $bookings,
            'employees' => $employees,
            'services' => $services,
            'owners' => $owners,
            'superAdminsCount' => $superAdminsCount,
            'ownersCount' => $ownersCount,
            'employeesCount' => $employeesCount,
            'usersCount' => $usersCount,
            'subSalonBookings' => $subSalonBookings,  // تمرير عدد الحجزات
            'subSalonNames' => $subSalonNames,  // تمرير أسماء الصالونات
        ]);
    }



}
