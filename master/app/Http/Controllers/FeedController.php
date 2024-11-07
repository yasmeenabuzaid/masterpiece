<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Feed;
    use App\Models\User;
    use App\Models\SubSalon;
    use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $feeds = collect();

        if ($user->isSuperAdmin()) {
            $users=User::all();
            $feeds = Feed::with(['user', 'subsalon'])->get();
        } elseif ($user->isOwner()) {
            $user->load('salon.subSalons');

            if ($user->salon && $user->salon->subSalons->isNotEmpty()) {
                $feeds = Feed::with(['user', 'subsalon'])
                    ->whereIn('sub_salons_id', $user->salon->subSalons->pluck('id'))
                    ->get();
            } else {
                $feeds = collect();
            }
        }

        return view('dashboard.feedbacks.index', compact('feeds'));
    }






    public function create($subSalonId)
    {
        $subsalon = SubSalon::findOrFail($subSalonId);
        $feeds = Feed::with('user')->where('sub_salons_id', $subsalon)->get(); // الحصول على التقييمات الخاصة بهذا الصالون
        return view('user_side.more_details', compact('subSalon', 'feeds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string|max:255',
            'rating' => 'required|integer|between:1,5',
            'sub_salons_id' => 'required|exists:sub_salons,id',
        ]);

        Feed::create([
            'feedback' => $request->feedback,
            'rating' => $request->rating,
            'users_id' => Auth::id(),
            'sub_salons_id' => $request->sub_salons_id,
        ]);
   session()->flash('success', 'تم إضافة التعليق بنجاح!');

   return back();
    }




    public function show(Feed $feed)
    {
        return view('feeds.show', compact('feed'));
    }

    public function edit(Feed $feed)
    {
        return view('feeds.edit', compact('feed'));
    }

    public function update(Request $request, Feed $feed)
    {
        $request->validate([
            'feedback' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $feed->update($request->all());

        return redirect()->route('feeds.index')->with('success', 'تم تحديث التقييم بنجاح!');
    }

    public function destroy(Feed $feed)
    {
        $feed->delete();
        return redirect()->route('feeds.index')->with('success', 'تم حذف التقييم بنجاح!');
    }
}

