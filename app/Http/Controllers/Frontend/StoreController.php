<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\Blog;
use App\Models\Category;
use App\Models\District;
use App\Models\Product;
use App\Models\Variation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class StoreController extends Controller
{
    public function home(Request $request)
    {
        $all_categories = Category::all(['id', 'name_en', 'name_bn', 'cover_img']);
        $top_categories = Category::limit(5)->get(['id', 'name_en', 'name_bn', 'slug']);
        $products = Product::whereHas('categories', function ($p) use ($top_categories) {
            $p->whereIn('category_id', $top_categories->pluck('id')->toArray());
        })->get();
        $var_q = Variation::query();
        $var_q->where('district_id', session('district'));

        $featured = $var_q->whereHas('tags', function ($q) {
            $q->where('slug', 'featured');
        })->whereIn('product_id', $products->pluck('id')->toArray())->inRandomOrder()->limit(12)->get();

        $top_rated = $var_q->whereHas('tags', function ($q) {
            $q->where('slug', 'top-rated');
        })->latest()->inRandomOrder()->limit(9)->get()->chunk(3);

        $latest = $var_q->latest()->get()->chunk(3);
        return view('frontend.store.home', compact('top_categories', 'featured', 'top_rated', 'latest', 'all_categories'));
    }
    public function shop(Request $request)
    {
        $product_q = Product::query();
        $product_q->whereHas('variations', function ($p) use ($request) {
            $p->where('district_id', session('district'));
        });

        if ($request->category_id) {
            $product_q->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', $request->category_id)->orWhere('parent_id', $request->category_id);
            });
        }
        if ($request->product_name) {
            $product_q->where('name_' . app()->getLocale(), 'LIKE', '%' . $request->product_name . '%');
        }
        if ($request->minPrice) {
            $product_q->whereHas('variations', function ($v) use ($request) {
                $v->where('price', '>=', $request->minPrice);
            });
        }
        if ($request->maxPrice) {
            $product_q->whereHas('variations', function ($v) use ($request) {
                $v->where('price', '<=', $request->maxPrice);
            });
        }
        if ($request->sort) {
            $sort = explode('_', $request->sort);
            $product_q->whereHas('variations', function ($v) use ($sort) {
                $v->orderBy($sort[0], $sort[1]);
            });
        }
        $products = $product_q->paginate(24);
        return view('frontend.store.shop', compact('products'));
    }
    public function single(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product->variations()->where('district_id', session('district'))->count()) {
            return redirect()->route('front.shop');
        } else if ($request->has('var') and $product->variations->where('district_id', session('district'))->contains($request->var)) {
            $variation = $request->var;
        } else {
            $variation = $product->variations()->where('district_id', session('district'))->get()[0]->id;
        }
        $related_products = Product::whereHas('categories', function ($c) use ($product) {
            $c->whereIn('category_id', $product->categories->pluck('id')->toArray());
        })->whereHas('variations', function ($p) {
            $p->where('district_id', session('district'));
        })->whereDoesntHave('variations', function ($v) use ($variation) {
            $v->where('id', $variation);
        })->latest()->limit(8)->get();

        return view('frontend.store.single-product', [
            'product' => $product,
            'var' => $variation,
            'related_products' => $related_products
        ]);
    }
    public function selectDistrict(Request $request, $district)
    {
        if (District::find($district)->count()) {
            session()->put('district', $district);
        }
        return redirect()->back();
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
    public function store_subscriber(Request $request)
    {
        $request->validate([
            'email' => 'email|unique:subscribers,email',
        ]);

        DB::table('subscribers')->insert([
            'email' => $request->email,
            'created_at' => Carbon::now()
        ]);
        return back();
    }
    public function contact()
    {
        return view('frontend.store.contact');
    }

    public function do_contact(Request $request)
    {
        $request->validate([
            "name" => "string|required",
            "email" => "email|required",
            "message" => "string|required",
        ]);
        Mail::to(env('MAIL_FROM_ADDRESS', 'plenaryaqua@gmail.com'))->send(new ContactMail($request->only('name', 'email', 'message')));
        // dd($request->all());
        return redirect()->back();
    }
    // blogs
    public function blogs(Request $request)
    {
        $blogs_q = Blog::query();
        if ($request->search) {
            $blogs_q->where('title', 'LIKE', '%' . $request->search . '%')->orWhere('content', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->category) {
            $blogs_q->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }
        $blogs = $blogs_q->latest()->paginate(10);
        return view('frontend.blog.blog', compact('blogs'));
    }
    public function single_blog(Request $request, $slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        $blog->increment('views', 1);
        return view('frontend.blog.single', compact('blog'));
    }

    public function love()
    {
        $wishes = auth()->user()->loved_products;
        return view('frontend.store.love', compact('wishes'));
    }
    public function about()
    {
        return view('frontend.additional.about');
    }
    public function privacy()
    {
        return view('frontend.additional.policy');
    }
    public function terms()
    {
        return view('frontend.additional.terms');
    }
    public function faq()
    {
        return view('frontend.additional.faq');
    }
}
