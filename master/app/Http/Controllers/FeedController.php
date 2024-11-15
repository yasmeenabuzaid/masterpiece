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
            $user->load('salon.subsalon');

            if ($user->salon && $user->salon->subsalon->isNotEmpty()) {
                $feeds = Feed::with(['user', 'subsalon'])
                    ->whereIn('sub_salons_id', $user->salon->subsalon->pluck('id'))
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
        $feeds = Feed::with('user')->where('sub_salons_id', $subsalon)->get();
        return view('user_side.more_details', compact('subSalon', 'feeds'));
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'feedback' => 'required|string|max:255',
        'rating' => 'required|integer|between:1,5',
        'sub_salons_id' => 'required|exists:sub_salons,id',
    ]);

    if (!$validated['rating']) {
        return back()->withErrors(['rating' => 'Please provide a rating']);
    }


        Feed::create([
            'feedback' => $request->feedback,
            'rating' => $request->rating,
            'users_id' => Auth::id(),
            'sub_salons_id' => $request->sub_salons_id,
        ]);
   session()->flash('success', 'Your comment has been added successfully!');

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

        return redirect()->route('feeds.index')->with('success', 'Feedback updated successfully.');
    }

    public function destroy(Feed $feed)
    {
        $feed->delete();
        return redirect()->route('feeds.index')->with('success', 'User deleted successfully.');
    }
}

