<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('backend.projects.index', compact('projects'));
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
            "project_name_en" => "string|required",
            "project_name_bn" => "string|required",
            "project_desc_en" => "string|required",
            "project_desc_bn" => "string|required",
        ]);
        $project = Project::create([
            'slug' => Str::slug($request->project_name_en),
            'name_en' => $request->project_name_en,
            'name_bn' => $request->project_name_bn,
            'desc_en' => $request->project_desc_en,
            'desc_bn' => $request->project_desc_bn,
        ]);

        if ($request->hasFile('feature_img')) {
            $image = Storage::put('project/featured', $request->feature_img);
            $project->update([
                'featured_img' => $image
            ]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $project->update([
            'slug' => Str::slug($request->project_name_en),
            'name_en' => $request->project_name_en,
            'name_bn' => $request->project_name_bn,
            'desc_en' => $request->project_desc_en,
            'desc_bn' => $request->project_desc_bn,

        ]);
        if ($request->hasFile('feature_img')) {
            $image = Storage::put('project/featured', $request->feature_img);
            $project->update([
                'featured_img' => $image
            ]);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->back();
    }
}
