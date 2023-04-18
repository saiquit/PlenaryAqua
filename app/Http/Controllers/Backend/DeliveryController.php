<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = DB::table('delivery')->get();
        return view('backend.delivery.index', compact('deliveries'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'district_id' => 'required',
            'name_en' => 'required',
            'name_bn' => 'required',
            'cost' => 'required|numeric'
        ]);
        DB::table('delivery')->insert([
            "district_id" => $request->district_id,
            "name_en" => $request->name_en,
            "name_bn" => $request->name_bn,
            "cost" =>  $request->cost,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now(),
        ]);
        return \redirect()->back();
    }
    public function update(Request $request)
    {
        $delivery = DB::table('delivery')->where('id', $request->delivery_id);
        $delivery->update([
            "district_id" => $request->district_id,
            "name_en" => $request->name_en,
            "name_bn" => $request->name_bn,
            "cost" =>  $request->cost,
            "updated_at" => Carbon::now(),
        ]);
        return \redirect()->back();
    }
    public function destroy(Request $request)
    {
        DB::table('delivery')->where('id', $request->district_id)->delete();
        return redirect()->back();
    }
}
