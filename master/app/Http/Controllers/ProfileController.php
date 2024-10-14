<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = User::find(auth()->id());
        return view('dashboard.profile.index', ['user' => $user]); // Use forward slashes
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $user = User::find(auth()->id());

        return view('dashboard.profile.edit', compact('profile' ,'user')); // No .blade extension
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $user = User::find(auth()->id());

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'email' => 'required|string',
            'phone' => 'required|string|max:15',
        ]);

        \Log::info('Updating profile with data:', $request->all());

        $profile->update($request->only('name', 'phone'));

        $user->update([
            'password' => bcrypt($request->password), 
            'email' => $request->email,
        ]);

        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully!');
    }

}
