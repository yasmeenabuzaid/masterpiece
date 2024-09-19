<?php

namespace App\Http\Controllers;

use App\Models\SubSalon;
use App\Models\Salon;
use Illuminate\Http\Request;

class SubSalonController extends Controller
{

    public function index()
    {

            $user = auth()->user();

            if ($user->isSuperAdmin()) {
                $salons = Salon::all();
                $subsalons = SubSalon::all();
                return view('dashboard/subsalon/index', ['subsalons' => $subsalons, 'salons' => $salons]);
            } elseif ($user->isOwner()) {
                $subsalons = SubSalon::where('salons_id', $user->salon_id)->get();
                return view('dashboard/subsalon/index', ['subsalons' => $subsalons]); // إرجاع عرض الأونر
            } else {
                abort(403, 'Unauthorized access.');
            }

        }


    public function create()
    {

    $user = auth()->user();

    // تحقق إذا كان المستخدم مالكاً
    if ($user->isOwner()) {
        $salon = Salon::find($user->salon_id); // احصل على الصالون الخاص بالمالك
        return view('dashboard.subsalon.create', ['salons' => [$salon]]); // اجعل المصفوفة تحتوي على الصالون فقط
    }

    // إذا كان سوبر أدمن، اجلب كل الصالونات
    $salons = Salon::all();
    return view('dashboard.subsalon.create', ['salons' => $salons]);
}



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'salons_id' => 'required|exists:salons,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $subsalon = new SubSalon();
        $subsalon->name = $validatedData['name'];
        $subsalon->address = $validatedData['address'];
        $subsalon->description = $validatedData['description'];
        $subsalon->phone = $validatedData['phone'];
        $subsalon->salons_id = $validatedData['salons_id'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/subsalon/');
            $file->move($path, $filename);
            $subsalon->image = 'uploads/subsalon/' . $filename;
        }

        $subsalon->save();

        return redirect()->route('subsalons.index')->with('success', 'SubSalon created successfully.');
    }


    public function show(SubSalon $subsalon)
    {
    }


    public function edit(SubSalon $subsalon)
{
    $user = auth()->user();

    // تحقق إذا كان المستخدم مالكاً
    if ($user->isOwner()) {
        $salon = Salon::find($user->salon_id); // احصل على الصالون الخاص بالمالك
        return view('dashboard.subsalon.edit', [
            'subsalon' => $subsalon,
            'salons' => [$salon] // اجعل المصفوفة تحتوي على الصالون فقط
        ]);
    }

    // إذا كان سوبر أدمن، اجلب كل الصالونات
    $salons = Salon::all();

    return view('dashboard.subsalon.edit', [
        'subsalon' => $subsalon,
        'salons' => $salons
    ]);
}



    public function update(Request $request, SubSalon $subsalon)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'salons_id' => 'required|exists:salons,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $subsalon->name = $validatedData['name'];
        $subsalon->address = $validatedData['address'];
        $subsalon->description = $validatedData['description'];
        $subsalon->phone = $validatedData['phone'];
        $subsalon->salons_id = $validatedData['salons_id'];

        // Handle the image if it exists
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/subsalon/');
            $file->move($path, $filename);
            $subsalon->image = 'uploads/subsalon/' . $filename;
        }

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
