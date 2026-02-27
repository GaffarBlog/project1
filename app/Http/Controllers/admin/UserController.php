<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Image\Image;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'Desc')->paginate(20);
        $roles = Role::select('id', 'name')->get();

        return view('admin.users.users', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::select('id', 'name')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function create_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'nullable|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:Active,Inactive,Banned',
            'address' => 'nullable|string|max:1000',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:16',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Third Gender',

        ]);
        $userdata = [
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'status' => $request->status,
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,

        ];
        if ($request->file('avatar')) {
            $userdata['images'] = upload_file($request->file('avatar'), 'users');
        }
        User::updateOrCreate($userdata);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::select('id', 'name')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$request->id,
            'username' => 'required|string|unique:users,username,'.$request->id,
            'password' => 'nullable|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
            'status' => 'required|in:Active,Inactive,Banned',
            'address' => 'nullable|string|max:1000',
            'country' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'zip' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:18|min:10',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Third Gender',

        ]);
        $user = User::findOrFail($request->id);
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
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role_id' => $request->role_id,
            'status' => $request->status,
            'address' => $request->address,
            'country' => $request->country,
            'city' => $request->city,
            'zip' => $request->zip,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'images' => $images,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Delete user role
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
        ]);
        User::findOrFail($request->id)->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}
