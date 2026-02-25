<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RouteList;

class PermissionController extends Controller
{
    public function index($role_id)
    {
        $role = Role::findOrFail($role_id);
        $routes = RouteList::select('id', 'name', 'route')->whereNull('parent_id')->with('Childrens')->get();

        // return $routes;

        return view('admin.permissions.index', compact('role', 'routes'));
    }
}
