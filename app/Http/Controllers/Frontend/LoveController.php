<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class LoveController extends Controller
{
    public function storeLove(Request $request, $product)
    {
        if (!auth()->user()) {
            return redirect()->back()->with(['message' => 'Log in first!', 'type' => 'alert-danger bg-danger text-white border-0']);
        }
        $product = Product::findOrFail($product);
        if (auth()->user()->loved_products->contains($product->id)) {
            auth()->user()->loved_products()->detach($product);
        } else {
            auth()->user()->loved_products()->attach($product);
        }

        return redirect()->back();
    }
}
