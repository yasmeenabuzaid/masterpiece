<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\SubSalon;
use App\Models\User;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        // الحصول على الفئات بناءً على نوع المستخدم
        if ($user->isSuperAdmin()) {
            $categories = Categorie::all(); // السوبر أدمن يحصل على جميع الفئات
        } elseif ($user->isOwner()) {
            // الحصول على الفئات المرتبطة بالسب صالون الخاص بالأونر
            $categories = Categorie::where('sub_salons_id', $user->sub_salons_id)->get();
        } else {
            $categories = collect(); // إذا لم يكن لديه صلاحيات، فارغ
        }

        return view('dashboard.category.index', compact('categories'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subsalons = SubSalon::all();
        $users = User::all(); // تحميل المستخدمين
        return view('dashboard.category.create', compact('subsalons', 'users'));
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
            'user_id' => 'required|exists:users,id',
        ]);

        Categorie::create($validatedData); // Mass assignment

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subsalons = SubSalon::all();
        $users = User::all(); // تحميل المستخدمين
        $categorie = Categorie::findOrFail($id);
        return view('dashboard.category.edit', compact('categorie', 'subsalons', 'users'));
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
            'user_id' => 'required|exists:users,id',
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
