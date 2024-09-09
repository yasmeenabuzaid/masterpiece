<?php

namespace App\Http\Controllers;
use App\Models\Salon;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {

        $salons = Salons::all();
        
        return view('dashboard',$data);
    }

}
