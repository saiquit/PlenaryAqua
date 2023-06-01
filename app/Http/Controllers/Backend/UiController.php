<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use function GuzzleHttp\Promise\queue;

class UiController extends Controller
{
    public function slides()
    {
        $slides = DB::table('slides')->orderBy('created_at', 'desc')->get();
        return view('backend.ui.slides', compact('slides'));
    }
    public function storeSlide(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'banner_img' => 'file',
        //     "heading_en" => "string",
        //     "heading_bn" => "string",
        //     "sub_heading_en" => "string",
        //     "sub_heading_bn" => "string",
        //     "parent" => "string"
        // ]);

        $id = DB::table('slides')->insertGetId([
            'category_id' => $request['parent'],
            'heading_en' => $request['heading_en'],
            'heading_bn' => $request['heading_bn'],
            'sub_heading_en' => $request['sub_heading_en'],
            'sub_heading_bn' => $request['sub_heading_bn'],
            "active"     => isset($request['active']) ? true : false,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        if ($request->hasFile('banner_img')) {
            $image = Storage::put('slides/banner', $request->banner_img);
            DB::table('slides')->where('id', $id)->update([
                'image' => $image
            ]);
        }
        return redirect()->back();
    }
    public function update_slide(Request $request, $id)
    {

        DB::table('slides')->where('id', $id)->update([
            'category_id' => $request['parent'],
            'heading_en' => $request['heading_en'],
            'heading_bn' => $request['heading_bn'],
            'sub_heading_en' => $request['sub_heading_en'],
            'sub_heading_bn' => $request['sub_heading_bn'],
            "updated_at" => \Carbon\Carbon::now(),
            "active"     => isset($request['active']) ? true : false
        ]);

        if ($request->hasFile('banner_img')) {
            $image = Storage::put('slides/banner', $request->banner_img);
            DB::table('slides')->where('id', $id)->update([
                'image' => $image
            ]);
        }
        return redirect()->back();
    }
    public function delete(Request $request, $id)
    {
        DB::table('slides')->delete($id);
        return redirect()->back();
    }

    public function offers()
    {
        $offers = DB::table('offers')->orderBy('updated_at', 'desc')->get();
        return view('backend.ui.offers', compact('offers'));
    }

    public function store_offers(Request $request)
    {
        $id = DB::table('offers')->insertGetId([
            'category_id' => $request['parent'],
            'product_id' => $request['product'],
            'heading_en' => $request['heading_en'],
            'heading_bn' => $request['heading_bn'],
            'sub_heading_en' => $request['sub_heading_en'],
            'sub_heading_bn' => $request['sub_heading_bn'],
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        if ($request->hasFile('banner_img')) {
            $image = Storage::put('offers/banner', $request->banner_img);
            DB::table('offers')->where('id', $id)->update([
                'image' => $image
            ]);
        }
        return redirect()->back();
    }

    public function update_offer(Request $request, $id)
    {

        DB::table('offers')->where('id', $id)->update([
            'category_id' => $request['parent'],
            'product_id' => $request['product'],
            'heading_en' => $request['heading_en'],
            'heading_bn' => $request['heading_bn'],
            'sub_heading_en' => $request['sub_heading_en'],
            'sub_heading_bn' => $request['sub_heading_bn'],
            "updated_at" => \Carbon\Carbon::now(),
            "active"     => isset($request['active']) ? true : false
        ]);

        if ($request->hasFile('banner_img')) {
            $image = Storage::put('offers/banner', $request->banner_img);
            DB::table('offers')->where('id', $id)->update([
                'image' => $image
            ]);
        }
        return redirect()->back();
    }
    public function delete_offer(Request $request, $id)
    {
        DB::table('offers')->delete($id);
        return redirect()->back();
    }

    public function newsletters()
    {
        $news = DB::table('newsletters')->orderBy('created_at', 'desc')->get();
        return view('backend.ui.newsletter', compact('news'));
    }
    public function store_news(Request $request)
    {
        $request->validate([
            // 'receivers' => 'required',
            // 'iframe_text' => 'required'
        ]);
        $receivers = [];
        if ($request->receivers && in_array('customers', $request->receivers)) {
            $receivers +=  DB::table('users')->where('type', 'customer')->pluck('email')->toArray();
        }
        if ($request->receivers && in_array('subscribers', $request->receivers)) {
            $receivers += DB::table('subscribers')->get()->pluck('email')->toArray();;
        }
        foreach (explode(',', $request->emails) as $key => $email) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($receivers, $email);
            }
        }
        foreach ($receivers as $key => $reciver) {
            Mail::from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))->to($reciver)->queue(new NewsletterMail($request->iframe_text));
        }
        $html_code = htmlspecialchars($request['iframe_text']);
        $sent_to = join(',', $request->receivers);
        DB::table('newsletters')->insert([
            'sent_to' => $sent_to,
            'sent_total' => count($receivers),
            'html' => $html_code,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        return redirect()->back();
    }
}
