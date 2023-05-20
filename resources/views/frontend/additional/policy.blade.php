@extends('layouts.frontend.base')
@section('title')
    Privacy Policy
@endsection
@section('main')
    <section class="py-5 my-5">
        <div class="container px-5">
            <div>
                <h1>{{ __('additional.privacy_heading') }}</h1>
                <hr>
                {!! collect(
                    DB::table('pages_data')->where('name', 'r_policy')->first(),
                )[app()->getLocale()] !!}
            </div>
        </div>
    </section>
@endsection
