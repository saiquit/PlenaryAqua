<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->orders->count()) {
            foreach (auth()->user()->orders as $key => $order) {
                if (!$order->variations->contains('product_id', $request->product_id)) {
                    return redirect()->back()->with(['message' => 'No previous order found! You have not bought this product.', 'type' => 'alert-danger']);
                }
            }
        } else {
            return redirect()->back()->with(['message' => 'No previous order found! You have not bought this product.', 'type' => 'alert-danger']);
        }
        if (!auth()->user()->comments->where('product_id', $request->product_id)->count()) {
            auth()->user()->comments()->create([
                'comment' => $request->content,
                'product_id' => $request->product_id
            ]);
        };
        return redirect()->back();
    }
}
