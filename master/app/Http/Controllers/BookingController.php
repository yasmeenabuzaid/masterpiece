<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Booking;
use App\Models\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function showServices()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'يرجى تسجيل الدخول قبل رؤية الخدمات.');
        }
        $bookings =Booking::all();
        $services = Service::all();
        $bookingServices = BookingService::all();
        return view('services.index', compact('services' ,'bookings' ,'bookingServices'));
    }

    public function store(Request $request)
{
    // dd($request->all()); // استخدمها فقط للاختبار
    $request->validate([
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'note' => 'nullable|string',
        'services' => 'required|string',
    ]);

    // تحويل سلسلة الخدمات إلى مصفوفة
    $services = explode(',', $request->services);

    // تحقق من أن كل معرف خدمة موجود
    $request->merge(['services' => $services]); // قم بتحديث البيانات

    $request->validate([
        'services.*' => 'exists:services,id',
    ]);

    try {
        $booking = Booking::create([
            'name' => $request->name ?? auth()->user()->name,
            'date' => $request->date,
            'time' => $request->time,
            'email' => $request->email ?? auth()->user()->email,
            'note' => $request->note,
            'user_id' => auth()->id(),
        ]);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'حدث خطأ أثناء إنشاء الحجز: ' . $e->getMessage());
    }

    foreach ($services as $service_id) {
        BookingService::create([
            'booking_id' => $booking->id,
            'service_id' => $service_id,
        ]);
    }

    return redirect()->back()->with('success', 'Booking was successful!');
}




    // عرض تفاصيل الحجز
    public function get(Booking $booking)
    {
        $user = auth()->user();

        $bookings = Booking::where('user_id', $user->id)->get();

        $services = Service::all();

        $bookingServices = BookingService::all();

        return view('user_side.confirmation', compact('services', 'bookings', 'bookingServices'));
    }

    // عرض نموذج تعديل الحجز
    public function edit(Booking $booking)
    {
        // محتوى الدالة حسب الحاجة
    }

    // تحديث الحجز
    public function update(Request $request, Booking $booking)
    {
        // محتوى الدالة حسب الحاجة
    }

    // حذف الحجز
    public function destroy(Booking $booking)
    {
        // محتوى الدالة حسب الحاجة
    }
}
