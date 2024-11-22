<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\BookingService;
use App\Models\SubSalon;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Salon;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $categories = collect();

        $search = request('search');

        if ($user->isSuperAdmin()) {
            $categories = Categorie::when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })->get();
        } elseif ($user->isOwner()) {
            $subSalon = $user->salon->subSalon;

            if ($subSalon->isNotEmpty()) {
                $categories = Categorie::whereIn('sub_salons_id', $subSalon->pluck('id'))
                    ->when($search, function ($query) use ($search) {
                        return $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->with('subSalon.salon')
                    ->get();
            }
        }

        return view('dashboard.category.index', compact('categories'));
    }


    public function show_CategoriesBySalon($salonId = null, $subSalonId = null)
    {
        if ($subSalonId) {
            $subSalon = SubSalon::findOrFail($subSalonId);
            $categories = $subSalon->categories;
        }
        elseif ($salonId) {
            $salon = Salon::findOrFail($salonId);
            $subSalons = $salon->subSalons;
            $categories = Categorie::whereIn('sub_salons_id', $subSalons->pluck('id'))->get();
        } else {
            return redirect()->route('home')->with('error', 'Salon or SubSalon not found');
        }

        return view('user_side.all-categoies', compact('categories', 'salon', 'subSalon'));
    }

    public function create()
    {
        $user = auth()->user();

        $categories = collect();
        $subSalon = collect();  // type of array to save object or array

        if ($user->isSuperAdmin()) {
            $subSalon = SubSalon::all();
        } elseif ($user->isOwner()) {
            $salon = $user->salon;

            if ($salon && $salon->subsalon->isNotEmpty()) {
                $subSalon = $salon->subsalon;
                $categories = Categorie::whereIn('sub_salons_id', $subSalon->pluck('id'))->get();
                 // pluck is a method in laravel to git 1 item or more into collection
            } else {
                $subSalon = collect(); // array[ ]
            }
        }

        return view('dashboard.category.create', compact('categories', 'subSalon'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sub_salons_id' => 'required|exists:sub_salons,id',
        ]);

        $categorie = new Categorie($validatedData);

        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $subsalon = SubSalon::findOrFail($id);
        $categories = Categorie::all();
        $bookings = Booking::all();
        $bookingServices = BookingService::all();
        $services = Service::all();

        return view('user_side.categories', compact('categories', 'subsalon', 'bookings', 'bookingServices', 'services'));
    }

    public function edit($id)
{
    $user = auth()->user();

    $category = Categorie::findOrFail($id);

    $subSalon = collect();

    if ($user->isSuperAdmin()) {
        $subSalon = SubSalon::all();
    } elseif ($user->isOwner()) {
        $salon = $user->salon;

        if ($salon && $salon->subSalon) {
            $subSalon = $salon->subSalon;
        } else {
            $subSalon = collect();
        }
    }

    return view('dashboard.category.edit', compact('category', 'subSalon'));
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'sub_salons_id' => 'required|exists:sub_salons,id',
    ]);

    $category = Categorie::findOrFail($id);

    $category->update($validatedData);

    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
}


public function destroy($id)
{
    $categorie = Categorie::findOrFail($id);

    $categorie->services()->delete(); 
    $categorie->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
}

}
