<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user(); // 🔥 Use Laravel Auth

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

    // Validate inputs
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'nic_number' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'profile_pic' => 'nullable|image|max:2048',
            'nic_image' => 'nullable|image|max:2048',
        ]);

        // Update user info
        $user->fill($validated);

        // Handle file uploads
        if ($request->hasFile('profile_pic')) {
            $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        if ($request->hasFile('nic_image')) {
            $user->nic_image = $request->file('nic_image')->store('nic_images', 'public');
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }
}    