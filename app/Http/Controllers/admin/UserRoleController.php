<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserRoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('admin.users.user-role', compact('roles'));
    }

    public function create(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'description' => 'nullable|string',
        ]);
        Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.user-role.view')->with('success', 'User role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return response()->json(['role' => $role, 'status' => true]);
    }

    public function update(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255|unique:roles,name,'.$request->id,
            'description' => 'nullable|string',
        ]);
        $role = Role::findOrFail($request->id);
        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
        ]);

        return redirect()->route('admin.user-role.view')->with('success', 'User role updated successfully.');
    }

    // Delete user role
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:roles,id',
        ]);
        Role::findOrFail($request->id)->delete();

        return redirect()->route('admin.user-role.view')->with('success', 'User role deleted successfully.');
    }
}
