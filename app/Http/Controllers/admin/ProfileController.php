<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        return view('admin.auth.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'username' => 'required|string|unique:users,username,'.$user->id,
            'address' => 'nullable|string|max:1000',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:15',
            'phone' => 'nullable|string|max:16',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Third Gender',
        ]);
        $images = $user->images;
        if ($request->file('avatar')) {
            $images = upload_file($request->file('avatar'), 'users');
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'images' => $images,
        ]);

        return redirect()->route('admin.profile.index')->with('success', 'Profile updated successfully.');
    }
}
