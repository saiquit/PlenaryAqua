<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.variations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->product_id) {
            return redirect()->route('admin.dashboard');
        }
        $product = Product::findOrFail($request->product_id);
        return view('backend.variations.create', compact('product'));
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
            'vars'              => 'array|required',
            'variation_name_en' => 'required',
            'variation_name_bn' => 'required',
            'weight' => 'required|numeric',
            'gross_weight' => 'required|numeric',
            // 'variation_desc_en' => 'required',
            // 'variation_desc_bn' => 'required',
        ]);
        $product = Product::findOrFail($request->product);
        foreach ($request->vars as $key => $var) {
            if (isset($var['active'])) {
                $district = District::where('name_en', $key)->first();
                $newVar = $product->variations()->create([
                    'weight' => floatval($request['weight']),
                    'gross_weight' => floatval($request['gross_weight']),
                    'slug' => Str::slug($request['variation_name_en']),
                    'name_en' => $request['variation_name_en'],
                    'name_bn' => $request['variation_name_bn'],
                    'desc_en' => $request['variation_desc_en'],
                    'desc_bn' => $request['variation_desc_bn'],
                    'district_id'   => $district->id,
                    'stock' => intval($var['stock']),
                    'price' => floatval($var['price']),
                    'discounted_from_price' => floatval($var['discount']),
                    'discount' => floatval($var['discount_pc']),
                ]);
                $newVar->tags()->attach($request->tags);
            }
        }
        return redirect()->route('admin.products.show', compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(Variation $variation)
    {
        return view('backend.variations.show', compact('variation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function edit(Variation $variation)
    {
        return view('backend.variations.update', compact('variation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variation $variation)
    {
        $request->validate([
            'variation_name_en' => 'required',
            'variation_name_bn' => 'required',
            'weight' => 'required|numeric',
            'gross_weight' => 'required|numeric',
            // 'variation_desc_en' => 'required',
            // 'variation_desc_bn' => 'required',
        ]);
        $variation->update([
            'weight' => floatval($request['weight']),
            'gross_weight' => floatval($request['gross_weight']),
            'slug' => Str::slug($request['variation_name_en']),
            'name_en' => $request['variation_name_en'],
            'name_bn' => $request['variation_name_bn'],
            'desc_en' => $request['variation_desc_en'],
            'desc_bn' => $request['variation_desc_bn'],
            'stock' => intval($request['stock']),
            'price' => floatval($request['price']),
            'discounted_from_price' => floatval($request['discounted_from_price']),
            'discount' => floatval($request['discount']),
        ]);
        $variation->tags()->sync($request->tags);
        return redirect()->route('admin.products.show', $variation->product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variation $variation)
    {
        $variation->delete();
        return redirect()->back();
    }
}
