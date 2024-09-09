<?php

namespace App\Http\Controllers;

use App\Models\SubSalon;
use App\Models\Salon;
use Illuminate\Http\Request;

class SubSalonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salons = Salon::all();
        $subsalons = SubSalon::all();
        return view('dashboard/subsalon/index', ['subsalons' => $subsalons, 'salons' => $salons]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $salons = Salon::all(); // Fetch all salons
        return view('dashboard/subsalon/create', ['salons' => $salons]); // Pass to view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'salons_id' => 'required|exists:salons,id',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Create a new SubSalon object
        $subsalon = new SubSalon();
        $subsalon->name = $validatedData['name'];
        $subsalon->address = $validatedData['address'];
        $subsalon->phone = $validatedData['phone'];
        $subsalon->salons_id = $validatedData['salons_id'];
        // Handle the image if it exists
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $path = public_path('uploads/subsalon/');
        //     $file->move($path, $filename);
        //     $subSalon->image = 'uploads/subsalon/' . $filename;
        // }

        // Save the data in the database
        $subsalon->save();

        // Redirect after saving
        return redirect()->route('subsalons.index')->with('success', 'SubSalon created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubSalon $subsalon)
    {
        // Optionally, implement this method if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubSalon $subsalon)
    {
        $salons = Salon::all();

        // Return the view with existing subSalon data and salons list
        return view('dashboard/subsalon/edit', [
            'subsalon' => $subsalon,
            'salons' => $salons
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubSalon $subsalon)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'salons_id' => 'required|exists:salons,id',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update subSalon properties
        $subsalon->name = $validatedData['name'];
        $subsalon->address = $validatedData['address'];
        $subsalon->phone = $validatedData['phone'];
        $subsalon->salons_id = $validatedData['salons_id'];
        
        // Handle the image if it exists
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time() . '.' . $file->getClientOriginalExtension();
        //     $path = public_path('uploads/subsalon/');
        //     $file->move($path, $filename);
        //     $subSalon->image = 'uploads/subsalon/' . $filename;
        // }

        // Save the updated data in the database
        $subsalon->save();

        // Redirect after updating
        return redirect()->route('subsalons.index')->with('success', 'SubSalon updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubSalon $subsalon)
    {
        // Delete the subSalon instance
        $subsalon->delete();

        // Redirect after deletion
        return redirect()->route('subsalons.index')->with('success', 'SubSalon deleted successfully.');
    }
}
