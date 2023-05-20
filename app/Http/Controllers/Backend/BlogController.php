<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        $categories = Category::all('id', 'name_en');
        return view('backend.blog.index', compact('blogs', 'categories'));
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
        // dd($request->all());
        $request->validate([
            "title" => "string|required",
            "author" => "string|required",
            "content" => "string|required",
            "short_desc" => "string|required",
            "categories" => "array|required",
            "cover_img" => "required"
        ]);
        try {
            $blog =  Blog::create([
                "title" => $request->title,
                "author_name" => $request->author,
                "slug" => Str::slug($request->title),
                "content" => $request->content,
                "short_desc" => $request->short_desc,
            ]);
            $blog->categories()->attach($request->categories);
            if ($request->hasFile('cover_img')) {
                $image = Storage::put('blogs/cover', $request->cover_img);
                $blog->update([
                    'cover_img' => $image
                ]);
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        // dd($request->all());
        $request->validate([
            "title" => "string|required",
            "content" => "string|required",
            "short_desc" => "string|required",
            "author" => "string|required",
            "categories" => "array|required",
        ]);
        try {
            $blog->update([
                "title" => $request->title,
                "author_name" => $request->author,
                "slug" => Str::slug($request->title),
                "content" => $request->content,
                "short_desc" => $request->short_desc,
            ]);
            $blog->categories()->sync($request->categories);
            if ($request->hasFile('cover_img')) {
                $image = Storage::put('blogs/cover', $request->cover_img);
                $blog->update([
                    'cover_img' => $image
                ]);
            }
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        try {
            $blog->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
