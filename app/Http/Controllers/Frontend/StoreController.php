<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\District;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function home(Request $request)
    {
        $all_categories = Category::all(['id', 'name_en', 'name_bn']);

        $top_categories = Category::limit(5)->get(['id', 'name_en', 'name_bn']);
        $products = Product::whereHas('categories', function ($p) use ($top_categories) {
            $p->whereIn('category_id', $top_categories->pluck('id')->toArray());
        })->get();
        $var_q = Variation::query();

        $featured = $var_q->whereHas('tags', function ($q) {
            $q->where('slug', 'featured');
        })->whereIn('product_id', $products->pluck('id')->toArray())->inRandomOrder()->limit(60)->get();

        $top_rated = $var_q->whereHas('tags', function ($q) {
            $q->where('slug', 'top-rated');
        })->whereHas('current_district', function ($q) {
            $q->where('district_id', session('district'));
        })->latest()->inRandomOrder()->limit(9)->get()->chunk(3);

        $latest = $var_q->latest()->get()->chunk(3);
        return view('frontend.store.home', compact('top_categories', 'featured', 'top_rated', 'latest', 'all_categories'));
    }
    public function shop(Request $request)
    {
        $variations_q = Variation::query();
        $variations_q->whereHas('current_district', function ($d) {
            $d->where('district_id', session('district'));
        });

        if ($request->category_id) {
            $variations_q->whereHas('product', function ($p) use ($request) {
                $p->whereHas('categories', function ($q) use ($request) {
                    $q->where('category_id', $request->category_id)->orWhere('parent_id', $request->category_id);
                });
            });
        }
        if ($request->product_name) {
            $variations_q->where('name_' . app()->getLocale(), 'LIKE', '%' . $request->product_name . '%');
        }
        if ($request->minPrice) {
            $variations_q->whereHas('current_district', function ($d) use ($request) {
                $d->where('price', '>=', $request->minPrice);
            });
        }
        if ($request->maxPrice) {
            $variations_q->whereHas('current_district', function ($d) use ($request) {
                $d->where('price', '<=', $request->maxPrice);
            });
        }
        // if ($request->sort) {
        //     $sort_arr = explode('_', $request->sort);
        //     $sorted = $variations_q->with('current_district')->whereHas('current_district')('price', 'desc');
        //     dd($sorted->paginate(10));
        // }
        $variations = $variations_q->paginate(24);
        return view('frontend.store.shop', compact('variations'));
    }
    public function single(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($request->has('var')) {
            $variation = $request->var;
        } else {
            $variation = $product->variations()->whereHas('current_district', function ($d) {
                $d->where('district_id', session('district'));
            })->get()[0]->id;
        }
        return view('frontend.store.single-product', [
            'product' => $product,
            'var' => $variation,
        ]);
    }
    public function selectDistrict(Request $request, $district)
    {
        if (District::find($district)->count()) {
            session()->put('district', $district);
        }
        return redirect()->route('front.shop');
    }
    public function cart(Request $request)
    {
        if (!session('cart.items')) {
            return redirect()->back()->with(['message' => 'No Cart Items.', 'type' => 'alert-success bg-danger text-white border-0']);
        }
        return view('frontend.store.cart');
    }

    public function checkout(Request $request)
    {
        if (!session('cart.items')) {
            return redirect()->back()->with(['message' => 'No Cart Items.', 'type' => 'alert-success bg-danger text-white border-0']);
        }
        return view('frontend.store.checkout');
    }
}
