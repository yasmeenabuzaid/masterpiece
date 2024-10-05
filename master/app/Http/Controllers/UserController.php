<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Salon;
use App\Models\SubSalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sub_salons =SubSalon::all();
        $salons = Salon::all();
        $users = User::all();
        return view('dashboard.user.index', compact('users', 'salons','sub_salons'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $salons = Salon::all();
        $sub_salons =SubSalon::all();

        return view('dashboard.user.show', compact('user', 'salons' ,'sub_salons'));
    }

    public function employees()
{
    $sub_salons =SubSalon::all();
    $salons = Salon::all();
    $users = User::where('usertype', 'employee')->get();
    return view('dashboard.user.employees', compact('users', 'salons' ,'sub_salons'));
}

    public function owners()
    {
        $sub_salons =SubSalon::all();

        $salons = Salon::all();
        $users = User::where('usertype', 'owner')->get();
        return view('dashboard.user.owners', compact('users', 'salons','sub_salons'));
    }

    public function superAdmins()
    {
        $sub_salons =SubSalon::all();

        $salons = Salon::all();
        $users = User::where('usertype', 'super_admin')->get();
        return view('dashboard.user.superAdmins', compact('users', 'salons','sub_salons'));
    }
    public function castomors()
    {
        $sub_salons =SubSalon::all();

        $salons = Salon::all();
        $users = User::where('usertype', 'user')->get();
        return view('dashboard.user.castomors', compact('users', 'salons','sub_salons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subsalons =SubSalon::all();

        $salons = Salon::all();
        return view('dashboard.user.create', compact('salons','subsalons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'salons_id' => 'nullable|exists:salons,id',
            'sub_salons_id' => 'nullable|exists:sub_salons,id',
            'usertype' => 'required|in:super_admin,owner,employee,user',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::transaction(function () use ($validatedData, $request) {
            $user = new User();
            $user->fill([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'salons_id' => $validatedData['usertype'] === 'owner' ? $validatedData['salons_id'] : null,
'sub_salons_id' => $validatedData['usertype'] === 'employee' ? 'required|exists:sub_salons,id' : 'nullable|exists:sub_salons,id',
'usertype' => $validatedData['usertype'],
                'password' => bcrypt($validatedData['password']),
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('uploads/user/');

                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                $file->move($path, $filename);
                $user->image = 'uploads/user/' . $filename;
            }

            $user->save();
        });

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $salons = Salon::all();
        $subsalons = SubSalon::all();

        return view('dashboard.user.edit', compact('user', 'salons' ,'subsalons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'usertype' => 'required|in:super_admin,owner,employee,user',
            'salons_id' => 'nullable|exists:salons,id',
            'sub_salons_id' => 'nullable|exists:sub_salons,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->usertype = $validatedData['usertype'];
        $user->salons_id = $validatedData['salons_id'] ?? null;
        $user->sub_salons_id = $validatedData['usertype'] === 'employee' ? $validatedData['sub_salons_id'] : null;

        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/user/');
            $file->move($path, $filename);
            $user->image = 'uploads/user/' . $filename;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        if ($user->image) {
            @unlink(public_path($user->image));
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
