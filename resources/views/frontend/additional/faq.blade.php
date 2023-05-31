@extends('layouts.frontend.base')
@section('title')
    FAQ
@endsection
@push('css')
    <style>
        .section_padding_130 {
            padding-top: 130px;
            padding-bottom: 130px;
        }

        .faq_area {
            position: relative;
            z-index: 1;
            background-color: #f5f5ff;
        }

        .faq-accordian {
            position: relative;
            z-index: 1;
        }

        .faq-accordian .card {
            position: relative;
            z-index: 1;
            margin-bottom: 1.5rem;
        }

        .faq-accordian .card:last-child {
            margin-bottom: 0;
        }

        .faq-accordian .card .card-header {
            background-color: #ffffff;
            padding: 0;
            border-bottom-color: #ebebeb;
        }

        .faq-accordian .card .card-header h6 {
            cursor: pointer;
            padding: 1.75rem 2rem;
            color: #3f43fd;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -ms-grid-row-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .faq-accordian .card .card-header h6 span {
            font-size: 1.5rem;
        }

        .faq-accordian .card .card-header h6.collapsed {
            color: #070a57;
        }

        .faq-accordian .card .card-header h6.collapsed span {
            -webkit-transform: rotate(-180deg);
            transform: rotate(-180deg);
        }

        .faq-accordian .card .card-body {
            padding: 1.75rem 2rem;
        }

        .faq-accordian .card .card-body p:last-child {
            margin-bottom: 0;
        }

        @media only screen and (max-width: 575px) {
            .support-button p {
                font-size: 14px;
            }
        }

        .support-button i {
            color: #3f43fd;
            font-size: 1.25rem;
        }

        @media only screen and (max-width: 575px) {
            .support-button i {
                font-size: 1rem;
            }
        }

        .support-button a {
            text-transform: capitalize;
            color: #2ecc71;
        }

        @media only screen and (max-width: 575px) {
            .support-button a {
                font-size: 13px;
            }
        }
    </style>
@endpush
@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('static/f/img/banner/about.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text black_heading_text">
                        <h2>FAQ</h2>
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
                <div class="faq_area section_padding_130" id="faq">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-sm-8 col-lg-6">
                                <!-- Section Heading-->
                                <div class="section_heading text-center wow fadeInUp" data-wow-delay="0.2s"
                                    style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                    <h3><span>Frequently </span> Asked Questions</h3>
                                    <p></p>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- FAQ Area-->
                            <div class="col-12 ">
                                <div class="accordion faq-accordian">
                                    @if (DB::table('faqs')->count())
                                        @foreach (DB::table('faqs')->get() as $faq)
                                            <div class="card border-0 wow fadeInUp" data-wow-delay="0.2s"
                                                style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                                <div class="card-header" id="headingOne">
                                                    <h6 class="mb-0 collapsed" data-toggle="collapse"
                                                        data-target="#col-{{ Str::slug($faq->q) }}" aria-expanded="true"
                                                        aria-controls="col-{{ Str::slug($faq->q) }}">
                                                        {{ $faq->q }}<span class="lni-chevron-up"></span></h6>
                                                </div>
                                                <div class="collapse" id="col-{{ Str::slug($faq->q) }}"
                                                    aria-labelledby="headingOne">
                                                    <div class="card-body">
                                                        <p>{{ $faq->a }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 ">
                                <!-- Support Button-->
                                <div class="support-button text-center d-flex align-items-center justify-content-center mt-4 wow fadeInUp"
                                    data-wow-delay="0.5s"
                                    style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">
                                    <i class="lni-emoji-sad"></i>
                                    <p class="mb-0 px-2">Can't find your answers?</p>
                                    <a href="{{ route('front.contact') }}"> Contact us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
