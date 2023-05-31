<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
        ]);
        $category = Category::create([
            'name_en' => $request->category_name_en,
            'slug' => Str::slug($request->category_name_en),
            'name_bn' => $request->category_name_bn,
            'parent_id' => $request->parent,
        ]);
        if ($request->hasFile('cover_img')) {
            $image = Storage::put('category/cover', $request->cover_img);
            $category->update([
                'cover_img' => $image
            ]);
        }
        if ($request->hasFile('feature_img')) {
            $image = Storage::put('category/featured', $request->feature_img);
            $category->update([
                'featured_img' => $image
            ]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update([
            'name_en' => $request->category_name_en,
            'slug' => Str::slug($request->category_name_en),
            'name_bn' => $request->category_name_bn,
            'parent_id' => $request->parent,
            'sort'  => $request->sort
        ]);
        if ($request->hasFile('cover_img')) {
            $image = Storage::put('category/cover', $request->cover_img);
            $category->update([
                'cover_img' => $image
            ]);
        }
        if ($request->hasFile('feature_img')) {
            $image = Storage::put('category/featured', $request->feature_img);
            $category->update([
                'featured_img' => $image
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
