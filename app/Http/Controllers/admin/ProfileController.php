<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Image\Image;

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
            $avatar = $request->file('avatar');
            $avatarName = time().'.'.$avatar->getClientOriginalExtension();
            $avatar->move('storage/uploads/users', $avatarName);
            $path = 'storage/uploads/users/'.$avatarName;
            $images['original'] = asset($path);
            $webp_path = public_path('storage/uploads/users/webp/'.Str::replaceLast('.'.$avatar->getClientOriginalExtension(), '.webp', $avatarName));
            Image::load(public_path($path))
                ->format('webp')
                ->quality(80)
                ->save($webp_path);

            $images['webp'] = asset('storage/uploads/users/webp/'.Str::replaceLast('.'.$avatar->getClientOriginalExtension(), '.webp', $avatarName));
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
