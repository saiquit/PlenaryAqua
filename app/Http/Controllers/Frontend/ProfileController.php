<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
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
        ]);
        return redirect()->back();
    }
    public function update_pass(Request $request)
    {
        dd($request->all());
    }

    public function store_address(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "district" => "required|numeric",
            "upazila" => "required|numeric",
            "address" => "required|string",
            'type'    => 'required'
        ]);
        $addresses = auth()->user()->profile->addresses;
        foreach ($addresses as $key => $ad) {
            if ($ad->type ==  $request->type) {
                Address::destroy($ad->id);
            }
        }
        Address::create([
            'profile_id' => auth()->user()->profile->id,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'location' => $request->address,
            'type' => $request->type,
            'active' => !$addresses->count() ? true : false,
        ]);
        return redirect()->back();
    }
    public function update_current_address(Request $request)
    {
        // dd($request->all());
        $profiles = Profile::find($request->profile);
        foreach ($profiles->addresses as $key => $address) {
            if ($address->id == $request->address) {
                $address->active = true;
                $address->save();
            } else {
                $address->active = false;
                $address->save();
            }
        }
        return redirect()->back();
    }
    public function delete_address(Request $request, $id)
    {
        Address::destroy($id);
        return redirect()->back();
    }
}
