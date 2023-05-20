<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderReceivedMail;
use App\Models\District;
use App\Models\Order;
use App\Models\User;
use App\Models\Variation;
use App\Notifications\NewOrderNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'first_name' => 'string',
            'last_name' => 'string',
            'phone' => 'required',
            'email' => 'required',
            'pay' => 'required',
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $qty_total = session('cart.qty');
        $wt_total = session('cart.weight');
        $sub_total = session('cart.subTotal');
        $discount = session('cart.discount', 0);
        $dl_cost = DB::table('delivery')->find($request->upazila)->cost;
        $total = $sub_total + $dl_cost - $discount;
        $order_count = Order::whereMonth('created_at', Carbon::now()->month)->count();

        $order = Order::create([
            'order_id' => date('ym') . sprintf("%04d", $order_count + 1),
            'user_id' => auth() ?  auth()->id() : null,
            'total' => $total,
            'qty_total' => $qty_total,
            'sub_total' => $sub_total,
            'dl_total' => $dl_cost,
            'wt_total' => $wt_total,
            'discount' => $discount,
            'payment_method' => $request->pay,
            'phone' => $request->phone,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'district' => $request->district,
            'upazila' => $request->upazila,
            'address' => $request->address,
            'email' => $request->email,
        ]);
        foreach (session('cart.items') as $key => $item) {
            $order->variations()->attach($item->id, [
                'qty' => $item['qty'],
                'wt'  => $item['qty'] * $item['weight']
            ]);
            Variation::findOrFail($item->id)->decrement('stock', $item['qty']);
            DB::table('coupons')->where('id', session('cart.coupon'))->update(['avaliable' => DB::raw('avaliable - 1')]);
        }
        auth()->user()->profile->increment('point', intval($total));
        Notification::send(User::where('type', 'admin')->get(), new NewOrderNotification($order));
        Mail::to(auth()->user())->send(new OrderReceivedMail($order));
        session()->forget(['cart.items', 'cart.qty', 'cart.weight', 'cart.subTotal', 'cart.discount', 'cart.coupon']);
        return redirect()->route('order.invoice', $order->order_id);
    }

    public function invoice(Request $request, $order_id)
    {
        $order = auth()->user()->orders->where('order_id', $order_id)->first();
        if (!$order) {
            return \redirect()->back();
        }
        return view('frontend.store.invoice', compact('order'));
    }
}
