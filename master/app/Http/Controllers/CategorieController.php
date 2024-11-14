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
        if ($user->isSuperAdmin()) {
            $categories = Categorie::all();
        } elseif ($user->isOwner()) {
            $subSalons = $user->salon->subSalons;
            if ($subSalons->isNotEmpty()) {
                $categories = Categorie::whereIn('sub_salons_id', $subSalons->pluck('id'))
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
        $subsalons = SubSalon::all();
        return view('dashboard.category.create', compact('subsalons'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sub_salons_id' => 'required|exists:sub_salons,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $categorie = new Categorie($validatedData);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/categories/');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $categorie->image = 'uploads/categories/' . $filename;
        }

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
        $subsalons = SubSalon::all();
        $categorie = Categorie::findOrFail($id);
        return view('dashboard.category.edit', compact('categorie', 'subsalons'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_salons_id' => 'required|exists:sub_salons,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $categorie = Categorie::findOrFail($id);

        $categorie->update($validatedData);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/categories/');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $categorie->image = 'uploads/categories/' . $filename;
        }

        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
