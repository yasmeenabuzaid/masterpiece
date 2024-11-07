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
       // التحقق من القيم المرسلة
       $validatedData = $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|string|min:6',
           'salons_id' => 'nullable|exists:salons,id',  // تحقق من الصالون
           'sub_salons_id' => 'nullable|exists:sub_salons,id',  // تحقق من السب صالون
           'usertype' => 'required|in:super_admin,owner,employee,user',
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);

       // حفظ البيانات داخل قاعدة البيانات
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

           // إذا كان المستخدم من نوع "employee"، خزّن السب صالون
           if ($validatedData['usertype'] === 'employee') {
               $user->sub_salons_id = $validatedData['sub_salons_id'];
           } else {
               $user->sub_salons_id = null;
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
            'sub_salons_id' => 'nullable|exists:sub_salons,id',  // تأكد من وجود الحقل
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // استرجاع المستخدم
        $user = User::findOrFail($id);

        // تحديث بيانات المستخدم
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->usertype = $validatedData['usertype'];
        $user->salons_id = $validatedData['salons_id'] ?? null;

        // إذا كان نوع المستخدم هو "employee"، تحديث sub_salons_id فقط
        if ($validatedData['usertype'] === 'employee') {
            // تأكد من أن الحقل موجود في الطلب
            if ($request->has('sub_salons_id')) {
                $user->sub_salons_id = $validatedData['sub_salons_id'];
            } else {
                $user->sub_salons_id = null; // إذا لم يكن موجودًا، تعيينه إلى null
            }
        } else {
            $user->sub_salons_id = null; // إذا لم يكن المستخدم من نوع employee، تعيينه إلى null
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





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // تحقق إذا كان المستخدم هو سوبر أدمن
        if ($user->usertype === 'super_admin') {
            // إذا كان سوبر أدمن، منع الحذف
            return redirect()->route('users.index')->with('error', 'Cannot delete the super admin user.');
        }

        // إذا لم يكن سوبر أدمن، قم بحذف المستخدم
        if ($user->image) {
            @unlink(public_path($user->image));
        }
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

}
