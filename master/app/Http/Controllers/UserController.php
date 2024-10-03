<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Salon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salons = Salon::all();
        $users = User::all();
        return view('dashboard.user.index', compact('users', 'salons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $salons = Salon::all();
        return view('dashboard.user.create', compact('salons'));
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
            'usertype' => 'required|in:super_admin,owner,employee,user',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::transaction(function () use ($validatedData, $request) { // إضافة $request هنا
            $user = new User();
            $user->fill([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'salons_id' => $validatedData['salons_id'] ?? null,
                'usertype' => $validatedData['usertype'],
                'password' => bcrypt($validatedData['password']),
            ]);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('uploads/user/');

                // تأكد من وجود المجلد
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                $file->move($path, $filename);
                $user->image = 'uploads/user/' . $filename;
            }


            $user->save();
        });

        return redirect()->route('users.index')->with('success', 'Owner created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $salons = Salon::all();
        return view('dashboard.user.edit', compact('user', 'salons'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // البحث عن المستخدم باستخدام المعرف
        $user = User::findOrFail($id);

        // تحديث الحقول
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->usertype = $validatedData['usertype'];
        $user->salons_id = $validatedData['salons_id'] ?? null; // تصحيح هنا

        // تحديث كلمة المرور إذا كانت مدخلة
        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        // معالجة الصورة المرفوعة
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/user/');
            $file->move($path, $filename);
            $user->image = 'uploads/user/' . $filename;
        }

        // حفظ التغييرات في قاعدة البيانات
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
            @unlink(public_path($user->image)); // delete the image if exists
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Owner deleted successfully.');
    }
}
