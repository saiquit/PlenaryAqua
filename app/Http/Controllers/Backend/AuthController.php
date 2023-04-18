<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('backend.auth.login');
    }
    public function do_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['message' => 'Oppes! You have entered invalid credentials', 'type' => 'alert-danger']);
    }
}
