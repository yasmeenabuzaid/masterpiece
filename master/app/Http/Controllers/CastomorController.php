<?php

namespace App\Http\Controllers;

use App\Models\Castomor;
use Illuminate\Http\Request;

class CastomorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $castomors = Castomor::all();
        return view('dashboard.castomor.index', ['castomors' => $castomors]);
    }

    public function create()
    {
        return view('dashboard.castomor.create'); // Ensure this view exists and contains the form
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:castomors,email',
            'password' => 'required|string|min:6',
        ]);

        $castomor = new Castomor();
        $castomor->first_name = $validatedData['first_name'];
        $castomor->last_name = $validatedData['last_name'];
        $castomor->email = $validatedData['email'];
        $castomor->password = $validatedData['password'];
        $castomor->save();

        return redirect()->route('castomors.index')->with('success', 'Castomor created successfully.');
    }

    public function edit(Castomor $castomor)
    {
        return view('dashboard.castomor.edit', compact('castomor')); // Ensure this view exists and contains the form
    }

    public function update(Request $request, Castomor $castomor)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:castomors,email,' . $castomor->id,
            'password' => 'nullable|string|min:6',
        ]);

        $castomor->first_name = $validatedData['first_name'];
        $castomor->last_name = $validatedData['last_name'];
        $castomor->email = $validatedData['email'];
        $castomor->password = $validatedData['password'];
        $castomor->save();

        return redirect()->route('castomors.index')->with('success', 'Castomor updated successfully.');
    }

    public function destroy(Castomor $castomor)
    {
        $castomor->delete();
        return redirect()->route('castomors.index')->with('success', 'Castomor deleted successfully.');
    }


}
