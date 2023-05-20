<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = DB::table('coupons')->get();
        return view('backend.coupons.index', compact('coupons'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'key' => 'required',
            'active' => 'required',
            'amount' => 'required|numeric',
            'avaliable' => 'required|numeric',
            'validity' => 'required'
        ]);
        DB::table('coupons')->insert([
            "key" => $request->key,
            "active" => $request->active ? true : false,
            "amount" => floatval($request->amount),
            "avaliable" => intval($request->avaliable),
            "validity" =>  Carbon::createFromDate($request->validity)->toDateString(),
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        return \redirect()->back();
    }
    public function update(Request $request)
    {
        $coupon = DB::table('coupons')->where('id', $request->coupon_id);
        $coupon->update([
            "key" => $request->key,
            "active" => $request->active ? true : false,
            "amount" => floatval($request->amount),
            "avaliable" => intval($request->avaliable),
            "validity" =>  Carbon::createFromDate($request->validity)->toDateString(),
            "updated_at" => Carbon::now(),
        ]);
        return \redirect()->back();
    }
    public function destroy(Request $request)
    {
        DB::table('coupons')->where('id', $request->coupon_id)->delete();
        return redirect()->back();
    }
}
