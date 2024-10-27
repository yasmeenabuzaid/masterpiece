<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\SubSalon;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subsalons = SubSalon::all();
        return view('dashboard.category.create', compact('subsalons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sub_salons_id' => 'required|exists:sub_salons,id',
        ]);

        Categorie::create($validatedData); // Mass assignment

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }
    public function show($id)
    {
        $subsalon = SubSalon::findOrFail($id);
        $categories = Categorie::all();

        return view('user_side.categories', compact('categories', 'subsalon')); // إزالة الفاصلة الزائدة
    }



    public function edit($id)
    {
        $subsalons = SubSalon::all();
        $categorie = Categorie::findOrFail($id);
        return view('dashboard.category.edit', compact('categorie', 'subsalons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_salons_id' => 'required|exists:sub_salons,id',
        ]);

        $categorie = Categorie::findOrFail($id);
        $categorie->update($validatedData); // Mass assignment

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
