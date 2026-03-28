<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SignupController extends Controller
{
    public function showForm()
    {
        return view('auth.signup');
    }

    public function register(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'=>'required|string|max:255',
                'email'=>'required|email|unique:users,email',
                'phone'=>'required|string|max:20',
                'nic_number'=>'required|string|max:50',
                'role'=>'required|in:finder,provider,vendor',
                'profile_pic'=>'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
                'nic_image'=>'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
                'location'=>'required|string|max:255',
                'password'=>'required|string|min:6|confirmed',
            ]);

            // Handle file uploads efficiently
            $profilePicPath = null;
            $nicImagePath = null;
            
            if ($request->hasFile('profile_pic') && $request->file('profile_pic')->isValid()) {
                $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
            }
            
            if ($request->hasFile('nic_image') && $request->file('nic_image')->isValid()) {
                $nicImagePath = $request->file('nic_image')->store('nic_images', 'public');
            }

            // Create user with optimized query
            $user = User::create([
                'name'=>$validated['name'],
                'email'=>$validated['email'],
                'phone'=>$validated['phone'],
                'nic_number'=>$validated['nic_number'],
                'role'=>$validated['role'],
                'profile_pic'=>$profilePicPath,
                'nic_image'=>$nicImagePath,
                'location'=>$validated['location'],
                'password'=>Hash::make($validated['password']),
                'verification_status'=>'Pending',
            ]);

            // Store user id in session
            session(['user_id'=>$user->user_id]);

            return redirect()->route('login')->with('success', 'Account created successfully! Please login.');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            \Log::error('Signup error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred during signup. Please try again.')->withInput();
        }
    }
}
