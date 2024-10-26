<?php
namespace App\Http\Controllers;

use App\Models\SubSalon;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
                return view('dashboard/subsalon/index', ['subsalons' => $subsalons]);
            } else {
                abort(403, 'Unauthorized access.');
            }

        }
    public function create()
    {
        $user = auth()->user();
        $salons = $user->isOwner() ? Salon::where('id', $user->salon_id)->get() : Salon::all();
        return view('dashboard.subsalon.create', compact('salons'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'salon_id' => 'required|exists:salons,id',
            'working_days' => 'required|array',
            'opening_hours_start' => 'required|string',
            'opening_hours_end' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        Log::info('Working Days:', $validatedData['working_days']);
        $validatedData['working_days'] = json_encode($validatedData['working_days']);

        $validatedData['opening_hours_start'] = $this->convertTo24HourFormat(
            (int)$request->input('opening_hours_start'),
            $request->input('opening_hours_start_period')
        );

        $validatedData['opening_hours_end'] = $this->convertTo24HourFormat(
            (int)$request->input('opening_hours_end'),
            $request->input('opening_hours_end_period')
        );

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('subsalons', 'public');
        }

        try {
            SubSalon::create($validatedData);
            return redirect()->route('subsalons.index')->with('success', 'Sub salon created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating sub salon: ' . $e->getMessage());
            return redirect()->back()->withErrors(['db_error' => 'Failed to create sub salon.'])->withInput();
        }
    }

    private function convertTo24HourFormat($hour, $period)
    {
        if ($period === 'PM' && $hour < 12) {
            return $hour + 12;
        }
        if ($period === 'AM' && $hour == 12) {
            return 0;
        }
        return $hour;
    }
    public function showAllSubSalons()
    {
        $subsalons = SubSalon::all();
        return view('user_side.landing', ['subsalons' => $subsalons]);
    }
    public function MoreAllSubSalons()
    {
        $subsalons = SubSalon::all();
        return view('user_side\all_salons', ['subsalons' => $subsalons]);
    }
    public function show(SubSalon $subsalon)
    {
        $salons = Salon::all();
        return view('user_side\more_details', ['subsalon' => $subsalon, 'salons' => $salons]);
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

