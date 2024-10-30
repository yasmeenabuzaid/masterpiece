<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\BookingService;
use App\Models\SubSalon;
use App\Models\Booking;
use App\Models\Service; // تأكد من استيراد نموذج الخدمة
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $categories = Categorie::all();
        } elseif ($user->isOwner()) {
            $categories = Categorie::where('sub_salons_id', $user->sub_salons_id)->get();
        } else {
            $categories = collect();
        }

        return view('dashboard.category.index', compact('categories'));
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
        ]);

        Categorie::create($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $subsalon = SubSalon::findOrFail($id);
        $categories = Categorie::all();
        $bookings = Booking::all();
        $bookingServices = BookingService::all();
        $services = Service::all(); // استرجاع جميع الخدمات

        return view('user_side.categories', compact('categories', 'subsalon', 'bookings', 'bookingServices', 'services')); // تأكد من تمرير المتغيرات
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
        ]);

        $categorie = Categorie::findOrFail($id);
        $categorie->update($validatedData);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
