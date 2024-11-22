<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $categories = Categorie::all();

    $search = request('search');

    $services = Service::when($search, function ($query) use ($search) {
        return $query->where('name', 'like', '%' . $search . '%');
    })->get();

    return view('dashboard.services_salon.index', [
        'services' => $services,
        'categories' => $categories
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $categories = collect();

        if ($user->isSuperAdmin()) {
            $categories = Categorie::all();
        } elseif ($user->isOwner()) {
            $subSalons = $user->salon ? $user->salon->subsalon : collect();
            if ($subSalons->isNotEmpty()) {
                $categories = Categorie::whereIn('sub_salons_id', $subSalons->pluck('id'))->get();
            }
        }

        return view('dashboard.services_salon.create', compact('categories'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'categories_id' => 'required|exists:categories,id',
            'hours' => 'nullable|integer|min:0|max:23',
            'minutes' => 'nullable|integer|min:0|max:59',
            'price' => 'required|numeric|min:0',
        ]);

        $duration = ($request->input('hours', 0) * 60) + $request->input('minutes', 0);

        Service::create($request->only(['name', 'description', 'categories_id', 'price']) + ['duration' => $duration]);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }
    /**
     * Show the specified resource.
     */
    public function show()
    {
        $services = Service::all();
        $services = Service::all();
        $categories = Categorie::all();

        return view('user_side.services', compact('services', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $categories = Categorie::all();
        return view('dashboard.services_salon.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
   /**
 * Update the specified resource in storage.
 */
public function update(Request $request, Service $service)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'categories_id' => 'required|exists:categories,id',
        'hours' => 'nullable|integer|min:0|max:23',
        'minutes' => 'nullable|integer|min:0|max:59',
        'price' => 'required|numeric|min:0',
    ]);

    $duration = ($request->input('hours', 0) * 60) + $request->input('minutes', 0);

    $service->update($request->only(['name', 'description', 'categories_id', 'price']) + ['duration' => $duration]);

    return redirect()->route('services.index')->with('success', 'Service updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
