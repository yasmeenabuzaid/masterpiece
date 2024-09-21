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
    $user = auth()->user();

    if ($user->isSuperAdmin()) {
        $categories = Categorie::all();
        $subcategories = Subcat::all();
        return view('dashboard/subcategory/index', [
            'subcategories' => $subcategories,
            'categories' => $categories,
        ]);
    } else {
        $subcategories = Subcat::where('categories_id', $user->categories)->get();
        return view('dashboard/subcategory/index', [
            'subcategories' => $subcategories,
            'categories' => [], 
        ]);
    }
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

        $subcat = new Subcat(); // Create a new Subcat instance
        $subcat->name = $validatedData['name'];
        $subcat->description = $validatedData['description'];
        $subcat->categories_id = $validatedData['categories_id'];

        $subcat->save();

        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcat $subcat)
    {

    }

    public function update(Request $request, Subcat $subcat)
    {

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcat $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
    }



}
