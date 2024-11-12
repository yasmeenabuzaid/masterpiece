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

        // التحقق من نوع المستخدم
        if (auth()->user()->isSuperAdmin()) {
            // إذا كان المستخدم Super Admin، إظهار جميع المستخدمين
            $users = User::all();
        } elseif (auth()->user()->isOwner()) {
            // إذا كان المستخدم من نوع "Owner"، الحصول على الصالون الخاص به
            $salonId = auth()->user()->salons_id;

            // الحصول على sub_salons المرتبطة بالصالون الخاص بالـ Owner
            $subSalonsForOwner = SubSalon::where('salon_id', $salonId)->get();

            // إذا كانت هناك sub_salons للـ Owner، نعرض الموظفين المرتبطين بها
            if ($subSalonsForOwner->isNotEmpty()) {
                // استعلام لجلب الموظفين المرتبطين بـ sub_salons المرتبطة بالـ salon
                $users = User::whereIn('sub_salons_id', $subSalonsForOwner->pluck('id'))
                            ->where('usertype', 'employee') // نعرض فقط الموظفين
                            ->get();
            } else {
                $users = collect(); // إذا لم توجد sub_salons، نرجع مجموعة فارغة
            }
        } else {
            // إذا كان المستخدم ليس Super Admin أو Owner، إرجاع مجموعة فارغة
            $users = collect();
        }

        return view('dashboard.user.index', compact('users', 'salons', 'sub_salons'));
    }



    public function showUsers()
    {
        $ownersCount = User::where('usertype', 'owner')->count();
        $employeesCount = User::where('usertype', 'employee')->count();
        $customersCount = User::where('usertype', 'customer')->count();
        $superAdminsCount = User::where('usertype', 'super_admin')->count();

        // تأكد من أن القيم ليست فارغة
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
   // في دالة store() أو update()

   public function store(Request $request)
   {
       // طباعة البيانات المرسلة من النموذج
    //    dd($request->all());
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
            $user->salons_id = $validatedData['salons_id'];  // حفظ الـ salon_id
        } else {
            $user->salons_id = null;  // تعيين null إذا لم يكن owner
        }

        // إذا كان المستخدم من نوع "employee"، خزّن السب صالون
        if ($validatedData['usertype'] === 'employee') {
            $user->sub_salons_id = $validatedData['sub_salons_id'];  // حفظ الـ sub_salons_id
        } else {
            $user->sub_salons_id = null;  // تعيين null إذا لم يكن employee
        }

        // تشفير كلمة المرور
        $user->password = bcrypt($validatedData['password']);

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
        // التحقق من القيم المدخلة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'usertype' => 'required|in:super_admin,owner,employee,user',
            'salons_id' => 'nullable|exists:salons,id',
            'sub_salons_id' => 'nullable|exists:sub_salons,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // استرجاع المستخدم
        $user = User::findOrFail($id);

        // تحديث بيانات المستخدم
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->usertype = $validatedData['usertype'];

        // تحديث salons_id فقط إذا كان نوع المستخدم "owner"
        if ($validatedData['usertype'] === 'owner') {
            $user->salons_id = $validatedData['salons_id'] ?? null;
        } else {
            $user->salons_id = null;  // إذا لم يكن Owner، تعيينه null
        }

        // تحديث sub_salons_id فقط إذا كان نوع المستخدم "employee"
        if ($validatedData['usertype'] === 'employee') {
            $user->sub_salons_id = $validatedData['sub_salons_id'] ?? null;
        } else {
            $user->sub_salons_id = null;  // تعيينه null إذا لم يكن Employee
        }

        // تحديث كلمة المرور إذا كانت موجودة في الطلب
        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        // إذا كانت هناك صورة جديدة، تحميلها
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($user->image && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }

            // رفع الصورة الجديدة
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/user/');
            $file->move($path, $filename);
            $user->image = 'uploads/user/' . $filename;
        }

        // حفظ البيانات
        $user->save();

        // إعادة التوجيه مع رسالة نجاح
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
        // التحقق من البيانات المدخلة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:6',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // استرجاع المستخدم الحالي
        $user = auth()->user();

        // تحديث بيانات المستخدم (اسم المستخدم والبريد الإلكتروني)
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        // تحديث كلمة المرور إذا كانت موجودة
        if ($request->filled('password')) {
            $user->password = bcrypt($validatedData['password']);
        }

        // تحديث الصورة إذا كانت موجودة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($user->image && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }

            // رفع الصورة الجديدة
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/user/');
            $file->move($path, $filename);
            $user->image = 'uploads/user/' . $filename;
        }

        // حفظ التحديثات
        $user->save();

        // إعادة التوجيه مع رسالة نجاح
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
        $user = Auth::user(); // الحصول على المستخدم الحالي

        // التحقق من البيانات المدخلة وتحديثها
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'nullable|string|min:8|confirmed',  // فقط التحقق من كلمة المرور إذا كانت موجودة
        ]);

        // تحديث الاسم والبريد الإلكتروني
        $user->name = $request->name;
        $user->email = $request->email;

        // إذا تم إدخال كلمة مرور جديدة
        if ($request->filled('password')) {
            // تشفير كلمة المرور الجديدة
            $user->password = bcrypt($request->password);
        }

        // تحديث الصورة إذا كانت موجودة
          // تحديث الصورة إذا كانت موجودة
          if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($user->image && file_exists(public_path($user->image))) {
                @unlink(public_path($user->image));
            }

            // رفع الصورة الجديدة
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/user/');
            $file->move($path, $filename);
            $user->image = 'uploads/user/' . $filename;
        }

        // حفظ التحديثات
        $user->save();

        // إعادة توجيه المستخدم مع رسالة نجاح
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }





}
