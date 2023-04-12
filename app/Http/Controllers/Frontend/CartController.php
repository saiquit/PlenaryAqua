<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DeliveryCost;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function updateCart(Request $request)
    {
        $cart = Session::get('cart.items');
        if (isset($cart[$request->id])) {
            if ($request->qty > $cart[$request->id]->current_district[0]->pivot->stock) {
                if ($request->ajax()) {
                    return response()->json(['message' => 'More than Stocked! Max ' . $cart[$request->id]->current_district[0]->pivot->stock . ' can be added.', 'type' => 'alert-danger'], 404);
                }
                return redirect()->back()->with(['message' => 'More than Stocked! Max ' . $cart[$request->id]->current_district[0]->pivot->stock . ' can be added.', 'type' => 'alert-danger']);
            } else {
                $cart[$request->id]['qty'] = $request->qty;
                if ($request->qty == 0) {
                    unset($cart[$request->id]);
                }
                $updated_cart = $this->updateSessions($request, $cart);
            }
        } else {
            $cart[$request->id] = Variation::findOrFail($request->id);
            if (intVal($request->qty) > $cart[$request->id]->current_district[0]->pivot->stock) {
                if ($request->ajax()) {
                    return response()->json(['message' => 'More than Stocked! Max ' . $cart[$request->id]->current_district[0]->pivot->stock . ' can be added.', 'type' => 'alert-danger'], 404);
                }
                return redirect()->back()->with(['message' => 'More than Stocked! Max ' . $cart[$request->id]->current_district[0]->pivot->stock . 'can be added.', 'type' => 'alert-danger']);
            } else {
                $cart[$request->id]['qty'] = $request->qty;
                $updated_cart = $this->updateSessions($request, $cart);
            };
        }
        if ($request->ajax()) {
            return response()->json($updated_cart, 201);
        } else {
            return redirect()->back()->with(['message' => 'Item Added!', 'type' => 'alert-success']);
        }
    }

    public function deleteItemFromCart(Request $request)
    {
        $cart = session('cart.items');
        foreach ($cart as $key => $value) {
            if ($value['id'] == $request->id) {
                unset($cart[$key]);
            }
        }
        //put back in session array without deleted item
        $this->updateSessions($request, $cart);
        //then you can redirect or whatever you need
        if (!count($cart)) {
            return redirect()->route('front.home');
        } else {
            return redirect()->back();
        }
    }

    protected function updateSessions(Request $request, $cart)
    {
        Session::put('cart.items', $cart);
        $cartQty = 0;
        $subTotal = 0;
        $cartWeight = 0;
        if (count($cart)) {
            foreach ($cart as $key => $item) {
                $cartQty += $item['qty'];
                $cartWeight += floatval($cart[$item->id]['weight']) * $item['qty'];
                $subTotal += $cart[$item->id]->current_district[0]->pivot->price  * $item['qty'];
            }
            Session::put('cart.qty', $cartQty);
            Session::put('cart.weight', $cartWeight);
            Session::put('cart.subTotal', $subTotal);
        } else {
            Session::put('cart.base_dl', 0);
            Session::put('cart.weight', 0);
            Session::put('cart.qty', 0);
        }
        return [
            'cart'    => $cart,
            'subTotal' => $subTotal,
            'total' => $subTotal + ($cartWeight * session('cart.base_dl')),
            'weight' => $cartWeight,
            'message' => 'Cart Updated'
        ];
    }
}
