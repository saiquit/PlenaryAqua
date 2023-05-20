<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        $data = DB::table('pages_data')->get();

        return view('backend.pages.index', compact('data'));
    }
    public function store(Request $request)
    {
        foreach ($request->all() as $key => $item) {
            if (is_array($item)) {
                DB::table('pages_data')->updateOrInsert([
                    'name' => $key,
                ], [
                    'name' => $key,
                    'en'   => $item['en'],
                    'bn'   => $item['bn'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
        return redirect()->back();
    }
}
