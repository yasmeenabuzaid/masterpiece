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
        }
        elseif ($user->isOwner()) {
            $salon = Salon::find($user->salons_id);

            if (!$salon) {
                abort(404, 'Salon not found');
            }

            $subsalons = $salon->subSalons;
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
                // التأكد من أن الملف هو صورة
                if ($file->isValid()) {
                    $filename = uniqid() . '_' . $file->getClientOriginalName();
                    $path = public_path('uploads/subsalons/');
                    $file->move($path, $filename);

                    $images[] = [
                        'image' => 'uploads/subsalons/' . $filename,
                        'sub_salons_id' => $subsalon->id, // ربط الصورة بالصالون الفرعي
                    ];
                } else {
                    // تسجيل رسالة خطأ أو التعامل مع الحالة عند عدم صلاحية الملف
                    Log::error('Invalid image file: ' . $file->getClientOriginalName());
                }
            }

            // إدخال الصور في قاعدة البيانات
            Image::insert($images);
        }


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
    {
        $subsalons = SubSalon::with('feeds')->get();

        $filteredSubsalons = $subsalons->filter(function ($subsalon) {
            $averageRating = $subsalon->feeds->isEmpty() ? 0 : $subsalon->feeds->avg('rating');
            return $averageRating >= 3;
        });

        return view('user_side.landing', [
            'filteredSubsalons' => $filteredSubsalons,
            'allSubsalons' => $subsalons,
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
        $Images = Image::where('sub_salons_id', $subsalon->id)->get(); // Adjust foreign key if necessary
        $salons = Salon::all(); // Assuming you are getting all salons
        $workingDays = $subsalon->working_days; // No need to decode if it's already an array

        return view('dashboard.subsalon.edit', compact('subsalon', 'Images', 'salons', 'workingDays'));
    }



    public function update(Request $request, $id)
    {
        // Log the incoming request data
        Log::info('Update Request Data:', $request->all());

        // Find the SubSalon or fail
        $subsalon = SubSalon::findOrFail($id);

        // Validate the incoming request
        $validatedData = $request->validate([
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

        // Convert times to 24-hour format
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

        // Update the SubSalon with validated data
        $subsalon->update($validatedData);

        // Process images if any
        if ($request->hasFile('images')) {
            // حذف الصور القديمة إذا كانت موجودة
            foreach ($subsalon->images as $image) {
                $imagePath = public_path($image->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath); // حذف الصورة من القرص
                }
            }

            // إعداد مصفوفة لتخزين الصور الجديدة
            $images = [];
            foreach ($request->file('images') as $file) {
                if ($file->isValid()) {
                    $filename = uniqid() . '_' . $file->getClientOriginalName();
                    $path = public_path('uploads/subsalons/');
                    $file->move($path, $filename);

                    $images[] = [
                        'image' => 'uploads/subsalons/' . $filename,
                        'sub_salons_id' => $subsalon->id, // ربط الصورة بالصالون الفرعي
                    ];
                } else {
                    // تسجيل رسالة خطأ
                    Log::error('Invalid image file: ' . $file->getClientOriginalName());
                }
            }

            // إدخال الصور الجديدة في قاعدة البيانات
            Image::insert($images);
        }

        return redirect()->route('subsalons.index')->with('success', 'SubSalon updated successfully!');
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

