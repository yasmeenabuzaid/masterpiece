<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Salon;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salons = Salon::all();
        $owners = Owner::all();
        return view('dashboard/owner/index', ['owners' => $owners]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $salons = Salon::all();
        return view('dashboard/owner/create', ['salons' => $salons]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:owners,email',
            'password' => 'required|string|min:6',
            'salons_id' => 'required|exists:salons,id',
            // 'phone' => 'required|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // أنشئ كائن جديد من Owner
        $owner = new Owner();
        $owner->first_name = $validatedData['first_name'];
        $owner->last_name = $validatedData['last_name'];
        $owner->email = $validatedData['email'];
        // $owner->phone = $validatedData['phone'];
        $owner->salons_id = $validatedData['salons_id'];
        $owner->password =$validatedData['password']; 

        // التعامل مع الصورة إذا كانت موجودة
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/owner/');
            $file->move($path, $filename);
    
            // حفظ مسار الصورة في قاعدة البيانات
            $owner->image = 'uploads/owner/' . $filename;
        }

        // حفظ البيانات في قاعدة البيانات
        $owner->save();

        // إعادة التوجيه بعد الحفظ
        return redirect()->route('owners.index')->with('success', 'Owner created successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner)
    {
        $salons = Salon::all();
        return view('dashboard/owner/edit', [
            'owner' => $owner,
            'salons' => $salons
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Owner $owner)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:owners,email,' . $owner->id,
            'password' => 'nullable|string|min:6', // Password is optional during update
            'salons_id' => 'required|exists:salons,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update the Owner object
        $owner->first_name = $validatedData['first_name'];
        $owner->last_name = $validatedData['last_name'];
        $owner->email = $validatedData['email'];
        $owner->salons_id = $validatedData['salons_id'];
        
        // Handle the password update
        if ($request->filled('password')) {
            $owner->password = bcrypt($validatedData['password']); // Encrypt password
        }

        // Handle the image if it exists
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/owner/');
            $file->move($path, $filename);

            // Save the image path in the database
            $owner->image = 'uploads/owner/' . $filename;
        }

        // Save the updated data in the database
        $owner->save();

        // Redirect after updating
        return redirect()->route('owners.index')->with('success', 'Owner updated successfully.');
    }
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        $owner->delete();
        
        // Redirect to the salons index page
        return redirect()->route('owners.index')->with('success', 'Salon deleted successfully.');
    }
}
