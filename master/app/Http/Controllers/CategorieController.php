<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\BookingService;
use App\Models\SubSalon;
use App\Models\Booking;
use App\Models\Service; // تأكد من استيراد نموذج الخدمة
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            $categories = Categorie::all();
        } elseif ($user->isOwner()) {
            $categories = Categorie::where('sub_salons_id', $user->sub_salons_id)->get();
        } else {
            $categories = collect();
        }

        return view('dashboard.category.index', compact('categories'));
    }

    public function create()
    {
        $subsalons = SubSalon::all();
        return view('dashboard.category.create', compact('subsalons'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sub_salons_id' => 'required|exists:sub_salons,id',
        ]);

        // إنشاء كائن جديد لفئة
        $categorie = new Categorie($validatedData);

        // تخزين الصورة إذا تم رفعها
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/salon/');

            // تأكد من وجود المجلد
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            // نقل الصورة إلى المجلد
            $file->move($path, $filename);
            $categorie->image = 'uploads/salon/' . $filename; // تعيين مسار الصورة
        }

        // حفظ الفئة
        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }


    public function show($id)
    {
        $subsalon = SubSalon::findOrFail($id);
        $categories = Categorie::all();
        $bookings = Booking::all();
        $bookingServices = BookingService::all();
        $services = Service::all(); // استرجاع جميع الخدمات

        return view('user_side.categories', compact('categories', 'subsalon', 'bookings', 'bookingServices', 'services')); // تأكد من تمرير المتغيرات
    }

    public function edit($id)
    {
        $subsalons = SubSalon::all();
        $categorie = Categorie::findOrFail($id);
        return view('dashboard.category.edit', compact('categorie', 'subsalons'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sub_salons_id' => 'required|exists:sub_salons,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // إضافة تحقق للصورة
        ]);

        $categorie = Categorie::findOrFail($id);

        // تحديث خصائص الفئة
        $categorie->update($validatedData);

        // تخزين الصورة إذا تم رفعها
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path('uploads/salon/');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);
            $categorie->image = 'uploads/salon/' . $filename; // تعيين مسار الصورة
            $categorie->save(); // حفظ التحديثات
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }


    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
