@extends('layouts.frontend.base')
@section('title')
    Terms
@endsection
@section('main')
    <section class="py-5 my-5">
        <div class="container px-5">
            <div>
                <h1>{{ __('additional.terms_heading') }}</h1>
                <hr>
                {!! collect(
                    DB::table('pages_data')->where('name', 'terms')->first(),
                )[app()->getLocale()] !!}
            </div>
        </div>
    </section>
@endsection
