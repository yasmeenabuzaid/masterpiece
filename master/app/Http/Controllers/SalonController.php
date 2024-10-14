<?php

namespace App\Http\Controllers;
use App\Models\Salon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

if(auth()->check() && (auth()->user()->isSuperAdmin() ||auth()->user()->isOwner() )) {
class SalonController  extends Controller
{


    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $salons = Salon::all();
        } elseif ($user->isOwner()) {
            $salons = $user->salon()->get();

        } else {
            abort(403, 'Unauthorized access.');
        }

        return view('dashboard.salon.index', ['salons' => $salons]);
    }



    public function create()
    {
        if (auth()->check() && (auth()->user()->isSuperAdmin() )) {
            return view('dashboard/salon/create');
        }
        else{
            abort(403, 'You do not have permission to access this page.');

        }
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'required|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $salon = new Salon();
        $salon->name = $validatedData['name'];
        $salon->address = $validatedData['address'];
        $salon->description = $validatedData['description'];


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
    public function show()
    {
        // $salons = Salon::all();
        // return view('dashboard/salon/view', ['salons' => $salons]);
    }

    public function edit(Salon $salon)
    {
        if (auth()->check() && (auth()->user()->isSuperAdmin())){
            return view('dashboard/salon/edit', ['salon' => $salon]);
        }
        else{
            abort(403, 'You do not have permission to access this page.');

        }
        //
    //    return view('dashboard/salon/edit', ['salon' => $salon]);

    }

    public function update(Request $request, Salon $salon)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'description' => 'required|string',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $salon->name = $validatedData['name'];
        $salon->address = $validatedData['address'];
        $salon->description = $validatedData['description'];

        if ($request->hasFile('image')) {
            if ($salon->image && File::exists(public_path($salon->image))) {
                File::delete(public_path($salon->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/salon/');
            $file->move($path, $filename);

            $salon->image = 'uploads/salon/' . $filename;
        }

        $salon->save();

        return redirect()->route('salons.index')->with('success', 'Salon updated successfully.');
    }



    public function destroy(Salon $salon)
    {
        if ($salon->image && File::exists(public_path($salon->image))) {
            File::delete(public_path($salon->image));
        }


        $salon->delete();

        return redirect()->route('salons.index')->with('success', 'Salon deleted successfully.');
    }
}
}
