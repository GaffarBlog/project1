<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    public function index()
    {
        $user = User::first();
        if (!$user) {
            User::create([
                "name" => "Admin",
                "email" => "admin@gmail.com",
                "password" => Hash::make("123456"),
                "type" => "Admin",
            ]);
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request::only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard.index');
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }


    // logout 
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.index');
    }
}
