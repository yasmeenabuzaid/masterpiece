<?php
namespace App\Http\Controllers;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SalonController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $search = $request->get('search');

        $salonsQuery = Salon::query();

        if ($status === 'active') {
            $salonsQuery->whereNull('deleted_at');
        } elseif ($status === 'trashed') {
            $salonsQuery->onlyTrashed();
        }

        if ($search) {
            $salonsQuery->where('name', 'like', '%' . $search . '%');
        }

        $salons = $salonsQuery->get();

        $activeSalonsCount = Salon::whereNull('deleted_at')->count();
        $trashedSalonsCount = Salon::onlyTrashed()->count();

        return view('dashboard.salon.index', compact('salons', 'activeSalonsCount', 'trashedSalonsCount'));
    }


 // -------------------------------------------------------------------

    public function create()
    {
        if (auth()->check() && auth()->user()->isSuperAdmin()) {
            return view('dashboard/salon/create');
        }

        abort(403, 'You do not have permission to access this page.');
    }
// -------------------------------------------------------------------

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $salon = new Salon();
        $salon->name = $validatedData['name'];
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

        return redirect()->route('salons.index')->with('success', 'Salon created successfully.');
    }

// -------------------------------------------------------------------

    public function show(Salon $salon)
    {
        if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner() && $salon->owner_id === auth()->user()->id)) {
            return view('dashboard.salon.index', compact('salon'));
        }

        abort(403, 'Unauthorized access.');
    }
    public function edit(Salon $salon)
    {
        if (auth()->check() && auth()->user()->isSuperAdmin()) {
            return view('dashboard/salon/edit', ['salon' => $salon]);
        }

        abort(403, 'You do not have permission to access this page.');
    }

  // -------------------------------------------------------------------

    public function update(Request $request, Salon $salon)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $salon->name = $validatedData['name'];
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

 // -------------------------------------------------------------------

    public function destroy($id)
    {
        $salon = Salon::find($id);
        if ($salon) {
            $salon->delete();
            return redirect()->route('salons.index')->with('success', 'Salon deleted successfully.');
        }

        return redirect()->route('salons.index')->with('error', 'Salon not found.');
    }

// -------------------------------------------------------------------
public function view_Salon($id)
{
    $salon = Salon::find($id);

    if (!$salon) {
        return redirect()->route('salons.index')->with('error', 'Salon not found');
    }

    return view('dashboard.salon.show', [
        'salon' => $salon,
    ]);
}

// -------------------------------------------------------------------

    public function restore($id)
    { // زي سلة المحذوفات
        $salon = Salon::withTrashed()->find($id);
        if ($salon) {
            $salon->restore();
            return redirect()->route('salons.index')->with('success', 'Salon restored successfully.');
        }

        return redirect()->route('salons.index')->with('error', 'Salon not found.');
    }
// -------------------------------------------------------------------

public function forceDelete($id)
{
    $salon = Salon::with(['subsalon.feeds'])->onlyTrashed()->find($id);

    // Check if the salon exists
    if (!$salon) {
        return redirect()->route('salons.trashed')->with('error', 'Salon not found.');
    }

    // Ensure that $salon->subsalons is not null and is iterable
    if ($salon->subsalons) {
        foreach ($salon->subsalons as $subsalon) {
            // Delete associated feeds
            $subsalon->feeds()->delete();
        }

        // Force delete the subsalons
        foreach ($salon->subsalons as $subsalon) {
            $subsalon->forceDelete();
        }
    }

    // Force delete the salon itself
    $salon->forceDelete();

    return redirect()->route('salons.index')->with('success', 'Salon deleted successfully.');
}



    // -------------------------------------------------------------------
    public function trashed(Request $request)
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $salons = Salon::onlyTrashed()->get();
        } elseif ($user->isOwner()) {
            $salons = $user->salon()->onlyTrashed()->get();
        } else {
            abort(403, 'Unauthorized access.');
        }

        return view('dashboard.salon.trashed', ['salons' => $salons]);
    }


// -------------------------------------------------------------------


}
