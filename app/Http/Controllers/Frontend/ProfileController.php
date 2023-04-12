<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    public function profile(Request $request)
    {
        $profile = Profile::firstOrCreate(['user_id' => auth()->id()]);
        return view('frontend.profile', compact('profile'));
    }
    public function update(Request $request)
    {
        $profile = Profile::firstOrCreate(['user_id' => auth()->id()]);
        $profile->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'bio' => $request->bio,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'address' => $request->address,
        ]);
        return redirect()->back();
    }
    public function update_pass(Request $request)
    {
        dd($request->all());
    }
}
