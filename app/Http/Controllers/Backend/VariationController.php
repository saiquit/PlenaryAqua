<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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
            'variation_name_en' => 'required',
            'variation_name_bn' => 'required',
            'weight' => 'required|numeric',
            'variation_desc_en' => 'required',
            'variation_desc_bn' => 'required',
        ]);
        $product = Product::findOrFail($request->product);
        $newVar = $product->variations()->create([
            'sku' => sprintf('%04d', $product->id) . $product->variations()->count() + 1,
            'weight' => floatval($request['weight']),
            'slug' => Str::slug($request['variation_name_en']),
            'name_en' => $request['variation_name_en'],
            'name_bn' => $request['variation_name_bn'],
            'desc_en' => $request['variation_desc_en'],
            'desc_bn' => $request['variation_desc_bn'],
        ]);
        if ($request->has('images')) {
            foreach ($request->images as $key => $image) {
                $image = Storage::put('variation', $image);
                $newVar->images()->create([
                    'filename' => $image,
                ]);
            }
        }
        $newVar->tags()->attach($request->tags);

        if ($request->has('dhaka_active')) {
            $newVar->districts()->attach(1, [
                'stock' => $request['dhaka_stock'],
                'price' => $request['dhaka_price'],
                'discounted_from_price' => $request['dhaka_discount'],
                'discount' => $request['dhaka_discount_pc'],
            ]);
        }
        if ($request->has('khulna_active')) {
            $newVar->districts()->attach(2, [
                'stock' => $request['khulna_stock'],
                'price' => $request['khulna_price'],
                'discounted_from_price' => $request['khulna_discount'],
                'discount' => $request['khulna_discount_pc'],
            ]);
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
        // dd($request->all());
        $updatedVar = $variation->update([
            'weight' => floatval($request['weight']),
            'slug' => Str::slug($request['variation_name_en']),
            'name_en' => $request['variation_name_en'],
            'name_bn' => $request['variation_name_bn'],
            'desc_en' => $request['variation_desc_en'],
            'desc_bn' => $request['variation_desc_bn'],
        ]);

        if ($request->has('preloaded')) {
            $variation->images()->sync($request->preloaded);
        }
        if ($request->has('images')) {
            foreach ($request->images as $key => $image) {
                $image = Storage::put('variation', $image);
                $variation->images()->create([
                    'filename' => $image,
                ]);
            }
        }
        $variation->tags()->sync($request->tags);

        if ($request->has('dhaka_active')) {
            $variation->districts()->detach("1");
            $variation->districts()->attach(["1" => [
                'stock' => $request['dhaka_stock'],
                'price' => $request['dhaka_price'],
                'discounted_from_price' => $request['dhaka_discount'],
                'discount' => $request['dhaka_discount_pc'],
            ]]);
        } else {
            $variation->districts()->detach("1");
        }
        if ($request->has('khulna_active')) {
            $variation->districts()->detach("2");
            $variation->districts()->attach(["2" => [
                'stock' => $request['khulna_stock'],
                'price' => $request['khulna_price'],
                'discounted_from_price' => $request['khulna_discount'],
                'discount' => $request['khulna_discount_pc'],
            ]]);
        } else {
            $variation->districts()->detach("2");
        }
        return redirect()->back();
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
