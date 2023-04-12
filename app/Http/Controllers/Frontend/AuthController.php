<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('auth.login');
    }
    public function register(Request $request)
    {
        return view('auth.register');
    }
    public function doLogin(Request $request)
    {
        $validate = Validator::make($request->all(), [
            // 'phone' => 'required_if:email,null|regex:/[0-9]{11}/|digits:11',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }
        if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->remember)) {
            return redirect()->intended('profile');
        } else {
            return redirect()->back()->with(['message' => 'No User Found on ' . $request->phone, 'alert-type' => 'error']);
        }
    }
    public function doRegister(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'phone' => 'required|regex:/[0-9]{11}/|digits:11|unique:users,phone',
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        } else {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $user = User::create([
                    'phone' => $request->phone,
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]);
                $user->sendEmailVerificationNotification();
            } else {
            }
            return redirect()->route('front.home');
        }
    }
}
