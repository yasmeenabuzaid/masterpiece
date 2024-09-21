<?php
namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Salon;
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
    } else {
        $categories = Categorie::where('salons_id', $user->salon_id)->get();
    }

    return view('dashboard/category/index', ['categories' => $categories]);


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           $salons=Salon::all();
        return view('dashboard/category/create' ,['salons'=>$salons]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'salons_id' => 'required|exists:salons,id',

        ]);

        $categorie = new Categorie();
        $categorie->name = $validatedData['name'];
        $categorie->description = $validatedData['description'];
        $categorie->salons_id = $validatedData['salons_id'];
        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $salons=Salon::all();
        $categorie = Categorie::findOrFail($id);
        return view('dashboard/category/edit', ['categorie' => $categorie ,'salons' =>$salons]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'salons_id' => 'required|exists:salons,id',

        ]);

        $categorie = Categorie::findOrFail($id);
        $categorie->name = $validatedData['name'];
        $categorie->description = $validatedData['description'];
        $categorie->salons_id = $validatedData['salons_id'];

        $categorie->save();

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
