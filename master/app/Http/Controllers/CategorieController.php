<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\BookingService;
use App\Models\SubSalon;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Salon;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $categories = collect();

        $search = request('search');

        if ($user->isSuperAdmin()) {
            $categories = Categorie::when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })->get();
        } elseif ($user->isOwner()) {
            $subSalon = $user->salon->subSalon;

            if ($subSalon->isNotEmpty()) {
                $categories = Categorie::whereIn('sub_salons_id', $subSalon->pluck('id'))
                    ->when($search, function ($query) use ($search) {
                        return $query->where('name', 'like', '%' . $search . '%');
                    })
                    ->with('subSalon.salon')
                    ->get();
            }
        }

        return view('dashboard.category.index', compact('categories'));
    }


    public function show_CategoriesBySalon($salonId = null, $subSalonId = null)
    {
        if ($subSalonId) {
            $subSalon = SubSalon::findOrFail($subSalonId);
            $categories = $subSalon->categories;
        }
        elseif ($salonId) {
            $salon = Salon::findOrFail($salonId);
            $subSalons = $salon->subSalons;
            $categories = Categorie::whereIn('sub_salons_id', $subSalons->pluck('id'))->get();
        } else {
            return redirect()->route('home')->with('error', 'Salon or SubSalon not found');
        }

        return view('user_side.all-categoies', compact('categories', 'salon', 'subSalon'));
    }

    public function create()
    {
        // الحصول على المستخدم الحالي
        $user = auth()->user();

        // تحضير المتغيرات
        $categories = collect();  // لتخزين الفئات
        $subSalon = collect();   // لتخزين الصالونات الفرعية

        // إذا كان المستخدم SuperAdmin
        if ($user->isSuperAdmin()) {
            // الحصول على جميع الـ SubSalons
            $subSalon = SubSalon::all();
        } elseif ($user->isOwner()) {
            // إذا كان المستخدم Owner
            $salon = $user->salon; // الحصول على الصالون المرتبط بالمستخدم

            // تأكد من أن الصالون يحتوي على صالونات فرعية
            if ($salon && $salon->subsalon->isNotEmpty()) {
                $subSalon = $salon->subsalon; // الحصول على جميع الصالونات الفرعية المرتبطة بالصالون
                // الحصول على الفئات المرتبطة بالصـالونات الفرعية
                $categories = Categorie::whereIn('sub_salons_id', $subSalon->pluck('id'))->get();
            } else {
                // إذا لم يوجد صالونات فرعية
                $subSalon = collect();  // إعادة تعيينها إلى مجموعة فارغة
            }
        }

        // إعادة البيانات إلى العرض
        return view('dashboard.category.create', compact('categories', 'subSalon'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'sub_salons_id' => 'required|exists:sub_salons,id',
        ]);

        $categorie = new Categorie($validatedData);

        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $subsalon = SubSalon::findOrFail($id);
        $categories = Categorie::all();
        $bookings = Booking::all();
        $bookingServices = BookingService::all();
        $services = Service::all();

        return view('user_side.categories', compact('categories', 'subsalon', 'bookings', 'bookingServices', 'services'));
    }

    public function edit($id)
{
    // الحصول على المستخدم الحالي
    $user = auth()->user();

    // الحصول على الفئة (Category) التي نريد تعديلها
    $category = Categorie::findOrFail($id);

    // تحضير المتغيرات الأساسية
    $subSalon = collect();  // متغير لحفظ الصالونات الفرعية

    // إذا كان المستخدم SuperAdmin
    if ($user->isSuperAdmin()) {
        // الحصول على جميع الـ SubSalons
        $subSalon = SubSalon::all();
    } elseif ($user->isOwner()) {
        // إذا كان المستخدم Owner، نعرض فقط الـ SubSalons المرتبطة بالصالون
        $salon = $user->salon;

        // تأكد من أن الصالون يحتوي على SubSalons
        if ($salon && $salon->subSalon) {
            $subSalon = $salon->subSalon; // الحصول على الـ SubSalons الخاصة بالصالون
        } else {
            // إذا لم يكن هناك SubSalons
            $subSalon = collect(); // قم بتعيينها إلى مجموعة فارغة
        }
    }

    // إعادة البيانات إلى العرض
    return view('dashboard.category.edit', compact('category', 'subSalon'));
}

public function update(Request $request, $id)
{
    // التحقق من البيانات المدخلة
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'sub_salons_id' => 'required|exists:sub_salons,id',
    ]);

    // العثور على الفئة (Category) التي نريد تعديلها
    $category = Categorie::findOrFail($id);

    // تحديث البيانات
    $category->update($validatedData);

    // إعادة التوجيه مع رسالة نجاح
    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
}


    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
