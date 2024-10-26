<?php
namespace App\Http\Controllers;

use App\Models\WorkingHour;
use App\Models\SubSalon;
use Illuminate\Http\Request;

class WorkingHourController extends Controller
{
    public function index()
    {
        $subsalons = SubSalon::all();
        $workingHours = WorkingHour::all();
        return view('dashboard.working_hours.index', compact('workingHours', 'subsalons'));
    }

    public function create()
    {
        $subsalons = SubSalon::all();
        return view('dashboard.working_hours.create', compact('subsalons'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sub_salons_id' => 'required|exists:sub_salons,id',
            'day' => 'required|string|max:10',
            'is_holiday' => 'boolean',
            'start_time' => 'required_if:is_holiday,0|date_format:H:i',
            'end_time' => 'required_if:is_holiday,0|date_format:H:i',
        ]);

        if ($request->is_holiday) {
            $validatedData['start_time'] = null;
            $validatedData['end_time'] = null;
        }

        WorkingHour::create($validatedData);

        return redirect()->route('working_hours.index')->with('success', 'Working Hour created successfully.');
    }

    public function edit(WorkingHour $workingHour)
    {
        $subsalons = SubSalon::all();
        return view('dashboard.working_hours.edit', compact('workingHour', 'subsalons'));
    }

    public function update(Request $request, WorkingHour $workingHour)
    {
        $validatedData = $request->validate([
            'day' => 'required|string|max:10',
            'is_holiday' => 'boolean',
            'start_time' => 'required_if:is_holiday,0|date_format:H:i',
            'end_time' => 'required_if:is_holiday,0|date_format:H:i',
        ]);

        if ($request->is_holiday) {
            $validatedData['start_time'] = null;
            $validatedData['end_time'] = null;
        }

        $workingHour->update($validatedData);

        return redirect()->route('working_hours.index')->with('success', 'Working Hour updated successfully.');
    }

    public function destroy(WorkingHour $workingHour)
    {
        $workingHour->delete();

        return redirect()->route('working_hours.index')->with('success', 'Working Hour deleted successfully.');
    }
}

