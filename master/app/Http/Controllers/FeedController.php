<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Feed; // Adjust if your Feedback model is named differently
    use App\Models\SubSalon; // Adjust if your Feedback model is named differently
    use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    // عرض قائمة التقييمات
    public function index()
    {
        $feeds = Feed::with(['user', 'subsalon'])->get();
        return view('feeds.index', compact('feeds'));
    }

    public function create($subSalonId)
    {
        $subsalon = SubSalon::findOrFail($subSalonId); // تأكد من أنك تستورد النموذج الصحيح
        $feeds = Feed::with('user')->where('sub_salons_id', $subsalon)->get(); // الحصول على التقييمات الخاصة بهذا الصالون
        return view('user_side.more_details', compact('subSalon', 'feeds'));
    }

    // تخزين تقييم جديد
    public function store(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'sub_salons_id' => 'required|exists:sub_salons,id', // تحقق من أن هناك تحقق من وجود معرف الصالون
        ]);

        Feed::create([
            'feedback' => $request->feedback,
            'rating' => $request->rating,
            'users_id' => Auth::id(),
            'sub_salons_id' => $request->sub_salons_id,
        ]);

        return redirect()->back()->with('success', 'تم إرسال التقييم بنجاح!');
    }




    // عرض تقييم معين
    public function show(Feed $feed)
    {
        return view('feeds.show', compact('feed'));
    }

    // عرض نموذج لتحرير تقييم معين
    public function edit(Feed $feed)
    {
        return view('feeds.edit', compact('feed'));
    }

    // تحديث تقييم معين
    public function update(Request $request, Feed $feed)
    {
        $request->validate([
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $feed->update($request->all());

        return redirect()->route('feeds.index')->with('success', 'تم تحديث التقييم بنجاح!');
    }

    // حذف تقييم معين
    public function destroy(Feed $feed)
    {
        $feed->delete();
        return redirect()->route('feeds.index')->with('success', 'تم حذف التقييم بنجاح!');
    }
}

