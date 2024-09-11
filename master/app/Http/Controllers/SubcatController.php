<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Subcat;
use Illuminate\Http\Request;

class SubcatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::all();
        $subcategories = Subcat::all();
        return view('dashboard/subcategory/index', [
            'subcategories' => $subcategories,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categories = Categorie::all(); // Fetch categories for the create view
        return view('dashboard/subcategory/create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'categories_id' => 'required|exists:categories,id', // Correct table name 'categories'
        ]);

        $subcategorie = new Categorie();
        $subcategorie->name = $validatedData['name'];
        $subcategorie->description = $validatedData['description'];
        $subcategorie->categories_id = $validatedData['categories_id'];

        $subcategorie->save();
        // subcategorie
        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcat $subcat)
    {
        $categories = Categorie::all(); // Fetch categories for the edit view
        return view('dashboard/subcategory/edit', [
            'subcategorie' => $subcat,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcat $subcat)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcat->update($validatedData);

        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcat $subcat)
    {
        $subcat->delete();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }
}
