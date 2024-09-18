<?php

namespace App\Http\Controllers;

use App\Models\Salon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SalonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salons = Salon::all();
        // all() method = select *;
        // used to retrieve all records from a database table
        return view('dashboard/salon/index', ['salons' => $salons]);
    }


    public function create()
    {
        if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner())) {
            return view('dashboard/salon/create');
        }

        return redirect()->route('salons.index')->with('error', 'Unauthorized access.');
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'required|string',
            'phone' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $salon = new Salon();
        $salon->name = $validatedData['name'];
        $salon->address = $validatedData['address'];
        $salon->description = $validatedData['description'];
        $salon->phone = $validatedData['phone'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/salon/');
            $file->move($path, $filename);

            $salon->image = 'uploads/salon/' . $filename;
        }

        $salon->save();

        return redirect()->route('salons.index')->with('success', 'Salon created successfully.');
    }


    public function edit(Salon $salon)
    {
        return view('dashboard/salon/edit', ['salon' => $salon]);
    }

    public function update(Request $request, Salon $salon)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'required|string',
            'phone' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $salon->name = $validatedData['name'];
        $salon->address = $validatedData['address'];
        $salon->description = $validatedData['description'];
        $salon->phone = $validatedData['phone'];

        // Handle the image if it exists
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($salon->image && File::exists(public_path($salon->image))) {
                File::delete(public_path($salon->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/salon/');
            $file->move($path, $filename);

            // Update the image path in the database
            $salon->image = 'uploads/salon/' . $filename;
        }

        // Save the changes in the database
        $salon->save();

        // Redirect to the salons index page
        return redirect()->route('salons.index')->with('success', 'Salon updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salon $salon)
    {
        // Delete the associated image file if it exists
        if ($salon->image && File::exists(public_path($salon->image))) {
            File::delete(public_path($salon->image));
        }

        // Delete the salon
        $salon->delete();

        // Redirect to the salons index page
        return redirect()->route('salons.index')->with('success', 'Salon deleted successfully.');
    }
}
