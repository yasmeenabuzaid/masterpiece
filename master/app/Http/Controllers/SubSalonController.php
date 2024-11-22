<?php
namespace App\Http\Controllers;

use App\Models\SubSalon;
use App\Models\Salon;
use App\Models\User;
use App\Models\Feed;
use App\Models\Image;
use App\Models\Categorie;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class SubSalonController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = SubSalon::query(); // Create the base query

        $salons = null;

        // Handling access based on user role
        if ($user->isSuperAdmin()) {
            $salons = Salon::all();
            $subsalons = $query->get();  // Get all sub salons for SuperAdmin
        } elseif ($user->isOwner()) {
            $salon = Salon::find($user->salons_id);
            if (!$salon) {
                abort(404, 'Salon not found');
            }

            $subsalons = $salon->subsalon;  // Get sub salons for the salon of the owner
        } else {
            abort(403, 'Unauthorized access.');
        }

        // Apply filtering if the 'governorate' request parameter is filled
        if ($request->filled('governorate')) {
            $query->whereHas('salon', function($q) use ($request) {
                $q->where('location', 'LIKE', '%' . $request->governorate . '%');
            });
        }

        // Execute the query to get the filtered sub salons
        $subsalons = $query->get();

        return view('dashboard.subsalon.index', compact('subsalons', 'salons'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            'images.*' => 'nullable|image|max:4096',
            'type' => 'required|in:women,men,mixed',
            'map_iframe' => 'nullable',
        ]);

        Log::info('Working Days:', $validatedData['working_days']);
        $validatedData['working_days'] = json_encode($validatedData['working_days']);

        $opening_start_hour = $request->opening_hours_start_ampm === 'PM' && $request->opening_hours_start_hour != 12
            ? $request->opening_hours_start_hour + 12
            : ($request->opening_hours_start_ampm === 'AM' && $request->opening_hours_start_hour == 12 ? 0 : $request->opening_hours_start_hour);

        $validatedData['opening_hours_start'] = sprintf('%02d:%02d:00', $opening_start_hour, $request->opening_hours_start_minute);

        $opening_end_hour = $request->opening_hours_end_ampm === 'PM' && $request->opening_hours_end_hour != 12
            ? $request->opening_hours_end_hour + 12
            : ($request->opening_hours_end_ampm === 'AM' && $request->opening_hours_end_hour == 12 ? 0 : $request->opening_hours_end_hour);

        $validatedData['opening_hours_end'] = sprintf('%02d:%02d:00', $opening_end_hour, $request->opening_hours_end_minute);

        $subsalon = SubSalon::create($validatedData);

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = uniqid() . '_' . $file->getClientOriginalName();
                    $path = public_path('uploads/subsalons/');
                    $file->move($path, $filename);

                    $images[] = [
                        'image' => 'uploads/subsalons/' . $filename,
                        'sub_salons_id' => $subsalon->id,
                    ];
                } else {
                    Log::error('Invalid image file: ' . $file->getClientOriginalName());
                }
            }

            Image::insert($images);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/salon/');
            $file->move($path, $filename);
            $subsalon->image = 'uploads/subsalon/' . $filename;
        }

        $subsalon->save();


        return redirect()->route('subsalons.index')->with('success', 'Sub salon created successfully.');
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
    { $userCount = User::count();

        $salonCount = Salon::count();
        $subsalonCount = SubSalon::count();
        $allSubsalons = SubSalon::all();

        $bookingCount = Booking::count();
        $subsalons = SubSalon::with('feeds')->get();

        $filteredSubsalons = $subsalons->filter(function ($subsalon) {
            $averageRating = $subsalon->feeds->isEmpty() ? 0 : $subsalon->feeds->avg('rating');
            return $averageRating >= 4;
        });

        return view('user_side.landing', [
            'filteredSubsalons' => $filteredSubsalons,
            'allSubsalons' => $allSubsalons,
            'userCount' => $userCount,
            'bookingCount' => $bookingCount,
            'salonCount' => $salonCount,
            'subsalonCount' => $subsalonCount,

        ]);
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
            return redirect()->route('home')->with('error', 'Salon not found');
        }

        $categories = $subsalon->categories;

        $feeds = Feed::where('sub_salons_id', $subsalon->id)->get();

        $images = Image::where('sub_salons_id', $subsalon->id)->get();

        return view('user_side.more_details', [
            'subsalon' => $subsalon,
            'images' => $images,
            'feeds' => $feeds,
            'categories' => $categories
        ]);
    }

    public function viewSubSalon($id)
    {
        $subsalon = SubSalon::with(['salon', 'images'])->find($id);

        if (!$subsalon) {
            return redirect()->back()->with('error', 'SubSalon not found.');
        }

        $images = $subsalon->images;
        return view('dashboard.subsalon.show', [
            'subsalon' => $subsalon,
            'images' => $images,
        ]);
    }

    public function edit($id)
    {
        $subsalon = SubSalon::findOrFail($id);
        $Images = Image::where('sub_salons_id', $subsalon->id)->get();
        $salons = Salon::all();
        $workingDays = $subsalon->working_days;

        return view('dashboard.subsalon.edit', compact('subsalon', 'Images', 'salons', 'workingDays'));
    }

    public function showCategoriesAndServices($id)
    {
        $subsalon = SubSalon::find($id);

        if (!$subsalon) {
            return redirect()->route('home')->with('error', 'Salon not found');
        }

        $categories = $subsalon->categories()->with('services')->get();


        return view('user_side.categories', [
            'subsalon' => $subsalon,
            'categories' => $categories
        ]);
    }



//   ---------------------------------------------------- update-----------------------------------

    public function update(Request $request, $id)
    {
        Log::info('Update Request Data:', $request->all());

        $subsalon = SubSalon::findOrFail($id);

        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'location' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'salon_id' => 'required|exists:salons,id',
            'working_days' => 'required|array',
            'opening_hours_start_hour' => 'required|integer',
            'opening_hours_start_minute' => 'required|integer|between:0,59',
            'opening_hours_start_ampm' => 'required|string|in:AM,PM',
            'opening_hours_end_hour' => 'required|integer',
            'opening_hours_end_minute' => 'required|integer|between:0,59',
            'opening_hours_end_ampm' => 'required|string|in:AM,PM',
            'type' => 'required|string|in:women,men,mixed',
            'is_available' => 'nullable|boolean',
            'map_iframe' => 'nullable|string',
        ]);

        $validatedData['opening_hours_start'] = sprintf(
            '%02d:%02d:00',
            $this->convertTo24HourFormat($validatedData['opening_hours_start_hour'], $validatedData['opening_hours_start_ampm']),
            $validatedData['opening_hours_start_minute']
        );

        $validatedData['opening_hours_end'] = sprintf(
            '%02d:%02d:00',
            $this->convertTo24HourFormat($validatedData['opening_hours_end_hour'], $validatedData['opening_hours_end_ampm']),
            $validatedData['opening_hours_end_minute']
        );

        $subsalon->update($validatedData);

        if ($request->hasFile('images')) {
            foreach ($subsalon->images as $image) {
                $imagePath = public_path($image->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $images = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = uniqid() . '_' . $file->getClientOriginalName();
                    $path = public_path('uploads/subsalons/');
                    $file->move($path, $filename);

                    $images[] = [
                        'image' => 'uploads/subsalons/' . $filename,
                        'sub_salons_id' => $subsalon->id,
                    ];
                } else {

                    Log::error('Invalid image file: ' . $file->getClientOriginalName());
                }
            }

            Image::insert($images);
        }
        if ($request->hasFile('image')) {
            if ($subsalon->image && File::exists(public_path($subsalon->image))) {
                File::delete(public_path($subsalon->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/subsalons/');
            $file->move($path, $filename);

            $subsalon->image = 'uploads/subsalons/' . $filename;
        }


        $subsalon->save();
        return redirect()->route('subsalons.index')->with('success', 'SubSalon updated successfully!');
    }

//   ----------------------------------------------------delete------------------------------------
public function destroy(SubSalon $subsalon)
{
    $subsalon->images()->delete();

    $subsalon->feeds()->delete();

    $categories = $subsalon->categories;
    foreach ($categories as $category) {
        $category->services()->delete();
        $category->delete();
    }

    $subsalon->delete();

    return redirect()->route('subsalons.index')->with('success', 'SubSalon deleted successfully.');
}


}

