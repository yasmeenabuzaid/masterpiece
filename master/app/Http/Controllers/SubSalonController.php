<?php
namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\SubSalon;
use App\Models\Salon;
use App\Models\User;
use App\Models\Feed;
use App\Models\Image;
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
            'opening_hours_start_hour' => 'required',
            'opening_hours_start_minute' => 'required',
            'opening_hours_start_ampm' => 'required|string|in:AM,PM',
            'opening_hours_end_hour' => 'required',
            'opening_hours_end_minute' => 'required',
            'opening_hours_end_ampm' => 'required|string|in:AM,PM',
            'images.*' => 'nullable|image|max:2048',
            'type' => 'required|in:women,men,mixed',
            'map_iframe' => 'nullable',
        ]);

        Log::info('Working Days:', $validatedData['working_days']);
        $validatedData['working_days'] = json_encode($validatedData['working_days']);

        // Convert start time to 24-hour format
        $opening_start_hour = $request->opening_hours_start_ampm === 'PM' && $request->opening_hours_start_hour != 12
            ? $request->opening_hours_start_hour + 12
            : ($request->opening_hours_start_ampm === 'AM' && $request->opening_hours_start_hour == 12 ? 0 : $request->opening_hours_start_hour);

        $validatedData['opening_hours_start'] = sprintf('%02d:%02d:00', $opening_start_hour, $request->opening_hours_start_minute);

        // Convert end time to 24-hour format
        $opening_end_hour = $request->opening_hours_end_ampm === 'PM' && $request->opening_hours_end_hour != 12
            ? $request->opening_hours_end_hour + 12
            : ($request->opening_hours_end_ampm === 'AM' && $request->opening_hours_end_hour == 12 ? 0 : $request->opening_hours_end_hour);

        $validatedData['opening_hours_end'] = sprintf('%02d:%02d:00', $opening_end_hour, $request->opening_hours_end_minute);

        // Create the SubSalon
        $subsalon = SubSalon::create($validatedData);

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $path = public_path('uploads/subsalons/');
                $file->move($path, $filename);

                $images[] = [
                    'image' => 'uploads/subsalons/' . $filename,
                    'sub_salons_id' => $subsalon->id, // Link to the subsalon
                ];
            }

            // Ensure the Image model is properly set up for data insertion
            Image::insert($images);
        }

        return redirect()->route('subsalons.index')->with('success', 'Sub salon created successfully.');
    }




    private function convertTo24HourFormat($hour, $period)
    {
        if ($period === 'PM' && $hour < 12) {
            return $hour + 12; // تحويل PM
        }
        if ($period === 'AM' && $hour == 12) {
            return 0; // تحويل 12 AM إلى 0
        }
        return $hour; // لا حاجة لتغيير
    }

    public function showAllSubSalons()
    {
        $subsalons = SubSalon::all();
        return view('user_side.landing', ['subsalons' => $subsalons]);
    }
    public function MoreAllSubSalons(Request $request)
    {
        $query = SubSalon::with('salon');

        if ($request->filled('type')) {
            $query->whereHas('salon', function($q) use ($request) {
                $q->where('type', $request->type);
            });
        }

        if ($request->filled('governorate')) {
            $query->whereHas('salon', function($q) use ($request) {
                $q->where('location', 'LIKE', '%' . $request->governorate . '%');
            });
        }

        if ($request->filled('name')) {
            $query->whereHas('salon', function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            });
        }

        $subsalons = $query->get();

        return view('user_side.all_salons', ['subsalons' => $subsalons]);
    }


    public function show($id)
    {
        $subsalon = SubSalon::find($id);

        if (!$subsalon) {
            return redirect()->back()->with('error', 'Salon not found');
        }

        $categories = $subsalon->categories;
        $subsalon = SubSalon::with('categories')->find($id);
        $users = User::all();
        $feeds = Feed::all();
        $images = Image::where('sub_salons_id', $subsalon->id)->get();

        return view('user_side.more_details', [
            'subsalon' => $subsalon,
            'images' => $images,
            'feeds' => $feeds,
            'users' => $users,
            'categories' => $categories
        ]);
    }





    public function edit(SubSalon $subsalon)
{
    $user = auth()->user();

    if ($user->isOwner()) {
        $salon = Salon::find($user->salon_id);
        return view('dashboard.subsalon.edit', [
            'subsalon' => $subsalon,
            'salons' => [$salon]
        ]);
    }

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

