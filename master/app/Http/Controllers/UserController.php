<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Salon;
use App\Models\SubSalon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salons = Salon::all();
        $sub_salons = SubSalon::all();

        if (auth()->user()->isSuperAdmin()) {
            $users = User::all();
        } elseif (auth()->user()->isOwner()) {
            $salonId = auth()->user()->salons_id;

            $subSalonsForOwner = SubSalon::where('salon_id', $salonId)->get();

            if ($subSalonsForOwner->isNotEmpty()) { //method used to check whether a given variable
                $usersQuery = User::whereIn('sub_salons_id', $subSalonsForOwner->pluck('id'))
                //method is used to extract a single column's value
                                  ->where('usertype', 'employee');

                $users = $usersQuery->get();

                if ($users->isEmpty()) {
                    $users = collect();
                }
            } else {
                $users = collect();
            }
        } else {
            $users = collect();
        }

        if ($search = request('search')) {
            $users = $users->filter(function ($user) use ($search) {
                return strpos(strtolower($user->name), strtolower($search)) !== false;
            });
        }

        return view('dashboard.user.index', compact('users', 'salons', 'sub_salons'));
    }



    public function showUsers()
    {
        $ownersCount = User::where('usertype', 'owner')->count();
        $employeesCount = User::where('usertype', 'employee')->count();
        $customersCount = User::where('usertype', 'customer')->count();
        $superAdminsCount = User::where('usertype', 'super_admin')->count();

        $ownersCount = $ownersCount ?: 0;
        $employeesCount = $employeesCount ?: 0;
        $customersCount = $customersCount ?: 0;
        $superAdminsCount = $superAdminsCount ?: 0;

        return view('dashboard.index', compact('ownersCount', 'employeesCount', 'customersCount', 'superAdminsCount'));
    }



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
        $subsalons = SubSalon::all();
        $salons = Salon::all();
        return view('dashboard.user.create', compact('salons', 'subsalons'));
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

    // استخدام المعاملات لضمان الحفظ بشكل آمن في حالة وجود مشاكل
    DB::transaction(function () use ($validatedData, $request) {
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->usertype = $validatedData['usertype'];

        // إذا كان المستخدم من نوع "owner"، خزّن الصالون
        if ($validatedData['usertype'] === 'owner') {
            $user->salons_id = $validatedData['salons_id'];
        } else {
            $user->salons_id = null;
        }

        if ($validatedData['usertype'] === 'employee') {
            $user->sub_salons_id = $validatedData['sub_salons_id'];
        } else {
            $user->sub_salons_id = null;
        }

        $user->password = bcrypt($validatedData['password']);
 //خوارزميه لتخزين كلمه السر بشكل امن
        // إذا كان هناك صورة، قم بتحميلها
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

        // حفظ المستخدم في قاعدة البيانات
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
        return view('dashboard.user.edit', compact('user', 'salons', 'subsalons'));
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

        if ($validatedData['usertype'] === 'owner') {
            $user->salons_id = $validatedData['salons_id'] ?? null;
        } else {
            $user->salons_id = null;
        }

        if ($validatedData['usertype'] === 'employee') {
            $user->sub_salons_id = $validatedData['sub_salons_id'] ?? null;
        } else {
            $user->sub_salons_id = null;
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($user->image && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/user/');
            $file->move($path, $filename);
            $user->image = 'uploads/user/' . $filename;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    public function editProfile()
    {
        $user = auth()->user();

        $salons = Salon::all();
        $subsalons = SubSalon::all();

        return view('dashboard.user.editProfile', compact('user', 'salons', 'subsalons'));
    }
    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:6',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/user/');
            $file->move($path, $filename);
            $user->image = 'uploads/user/' . $filename;
        }

        $user->save();

        return redirect()->route('users.profile')->with('success', 'Profile updated successfully.');
    }


public function showProfile()
{
    $user = auth()->user();

    return view('dashboard.user.profile', compact('user'));
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->usertype === 'super_admin') {
            return redirect()->route('users.index')->with('error', 'Cannot delete the super admin user.');
        }

        if ($user->image) {
            @unlink(public_path($user->image));
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    public function updateProfileUser(Request $request)
    {
          $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:6',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = auth()->user();

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($request->hasFile('image')) {
            if ($user->image && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }

            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/user/');
            $file->move($path, $filename);
            $user->image = 'uploads/user/' . $filename;
        }

        $user->save();


        return redirect()->back()->with('success', 'Profile updated successfully!');
    }






}
