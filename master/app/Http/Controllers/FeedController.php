<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $feedbacks = Feed::all();
        return view('dashboard/feedback/index', ['feedbacks' => $feedbacks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'feedback' => 'required|string',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feed $feed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
  /**
 * Remove the specified resource from storage.
 */
public function destroy(Feed $feedback)
{
    $feedback->delete();

    // Redirect to the feedbacks index page
    return redirect()->route('feedbacks.index')->with('success', 'Feedback deleted successfully.');
}

}
