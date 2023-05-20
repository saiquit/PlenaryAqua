@extends('layouts.frontend.base')
@section('title')
    About Us
@endsection
@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('static/f/img/banner/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text black_heading_text">
                        <h2>About us</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('front.home') }}">Home</a>
                            <span>About</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <section class="py-5 my-5">
        <div class="container px-5">
            <div class="">
                <h1>{{ __('additional.about_heading') }}</h1>
                <hr>
                <p class="lead text-justify" style="line-height: 2.5rem; ">{!! collect(
                    DB::table('pages_data')->where('name', 'about')->first(),
                )[app()->getLocale()] !!}</p>
            </div>
        </div>
    </section>
@endsection
