<?php

namespace App\Http\Controllers;


use App\Models\Service;
use App\Models\SubSalon;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_salons = SubSalon::all();
        $services = Service::all();
        $users = User::all();
        return view('dashboard.services_salon.index', ['services' => $services, 'sub_salons' => $sub_salons,'users'=>$users ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all(); // Fetch categories for the create view
        $sub_salons = SubSalon::all();
        $users = User::all();

        return view('dashboard.services_salon.create', ['sub_salons' => $sub_salons ,'categories'=>$categories ,'users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_salons_id' => 'required|exists:sub_salons,id',
            'categories_id' => 'required|exists:categories,id',
            'users_id' => 'required|exists:users,id',
        ]);
        Service::create($request->all());

        return redirect()->route('services.index')->with('success', 'Subcategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $sub_salons = SubSalon::all();
        $categories = Categorie::all();

        return view('dashboard.services_salon.edit', compact('service', 'sub_salons', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_salons_id' => 'required|exists:sub_salons,id',
            'categories_id' => 'required|exists:categories,id',
        ]);

        $service->update($request->all());

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }
}
