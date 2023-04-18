<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(['id', 'name_en']);
        return view('backend.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name_en' => 'required',
            'product_name_bn' => 'required',
            'product_desc_en' => 'required',
            'product_desc_bn' => 'required',
            'categories' => 'array|required',
            'images'     => 'required'
        ]);

        $product = Product::create([
            'name_en' => $request->product_name_en,
            'slug' => Str::slug($request->product_name_en),
            'name_bn' => $request->product_name_bn,
            'desc_en' => $request->product_desc_en,
            'desc_bn' => $request->product_desc_bn,
        ]);
        if ($request->has('images')) {
            foreach ($request->images as $key => $image) {
                $image = Storage::put('products', $image);
                $product->images()->create([
                    'filename' => $image,
                ]);
            }
        }
        $product->categories()->attach($request->categories);
        return redirect()->route('admin.products.show', $product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all(['id', 'name_en']);
        return view('backend.products.update', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name_en' => 'required',
            'product_name_bn' => 'required',
            'product_desc_en' => 'required',
            'product_desc_bn' => 'required',
            'categories' => 'array'
        ]);

        $product->update([
            'name_en' => $request->product_name_en,
            'slug' => Str::slug($request->product_name_en),
            'name_bn' => $request->product_name_bn,
            'desc_en' => $request->product_desc_en,
            'desc_bn' => $request->product_desc_bn,
        ]);
        if ($request->has('preloaded')) {
            $product->images()->sync($request->preloaded);
        }
        if ($request->has('images')) {
            foreach ($request->images as $key => $image) {
                $image = Storage::put('products', $image);
                $product->images()->create([
                    'filename' => $image,
                ]);
            }
        }
        $product->categories()->sync($request->categories);
        return redirect()->route('admin.products.show', $product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
}
