<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Variation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // TODO: Dashboard page graphs 
        $orders_per_month = Order::with('variations')->get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m');
        });
        $data = [];
        foreach ($orders_per_month as $month => $orders) {
            foreach ($orders as $key => $order) {
                $data[$month]['name'] = Carbon::createFromFormat('m', $month)->format('M');
                if (isset($data[$month]['total'])) {
                    $data[$month]['total'] += $order->total;
                } else {
                    $data[$month]['total'] = 1;
                }
            }
        }
        krsort($data);
        $data = array_splice($data, 0, 12);

        //Pi graph product
        $pi_data = [];
        $order_var = DB::table('order_variation')->get();
        foreach ($order_var as $key => $item) {
            // dump(Variation::find($item->variation_id)->name_en);
            if (isset($pi_data[Variation::find($item->variation_id)->name_en])) {
                $pi_data[Variation::find($item->variation_id)->name_en] += 1;
            } else {
                $pi_data[Variation::find($item->variation_id)->name_en] = 1;
            }
        }
        return view('backend.dashboard', compact('data', 'pi_data'));
    }
}
