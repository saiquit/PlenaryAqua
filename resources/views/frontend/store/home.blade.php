@extends('layouts.frontend.base')
@section('title')
    Home
@endsection

@section('main')
    <section id="services" class="my-lg-14 my-8">
        <div class="container">
            {{-- <div class="section-title">
                <h2>Our Services</h2>
            </div> --}}
            <div class="row">
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="mb-8 mb-xl-0">
                        <div class="mb-6">
                            <div class="icon_cover"><i class="icon icon_cart_alt"></i></div>
                        </div>
                        <h3 class="h5 mb-3">
                            Farm to your home
                        </h3>
                        <p class="text-justify">Farmers provide fresh fish and meat, which is then procured and, in response
                            to consumer
                            demand, delivered to their doorsteps ready to cook. </p>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="mb-8 mb-xl-0">
                        <div class="mb-6">
                            <div class="icon_cover"><i class="icon icon_bag"></i></div>
                        </div>
                        <h3 class="h5 mb-3">Support 24/7</h3>
                        <p class="text-justify">Choose from our uploaded product categories and contact us 24 hours a day, 7
                            days a week.</p>
                    </div>
                </div>
                <div class="col-6 col-md-6  col-lg-3">
                    <div class="mb-8 mb-xl-0">
                        <div class="mb-6">
                            <div class="icon_cover"><i class="icon icon_gift_alt"></i></div>
                        </div>
                        <h3 class="h5 mb-3">Secure payment</h3>
                        <p class="text-justify">We provide a cheaper price than your nearest supermarket, online shop, or
                            local market. And
                            if you are not satisfied with the products, return them and get a refund, as mentioned in our
                            return policy.</p>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3">
                    <div class="mb-8 mb-xl-0">
                        <div class="mb-6">
                            <div class="icon_cover"><i class="icon icon_refresh"></i></div>
                        </div>
                        <h3 class="h5 mb-3">Easy Returns</h3>
                        <p class="text-justify">We ensure secure payment on our website, and cash on delivery is also
                            available.
                            <a href="{{ route('front.policy') }}">policy</a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($all_categories as $category)
                        <div class="col-lg-3">
                            <div class="categories__item">
                                <img src="{{ isset($category->cover_img) ? url('storage/' . $category->cover_img) : asset('static/f/img/categories/cat-' . rand(1, 5) . '.jpg') }}"
                                    alt="">
                                <h5><a
                                        href="{{ route('front.shop', ['category_id' => $category->id]) }}">{{ $category['name_' . app()->getLocale()] }}</a>
                                </h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{ __('home.Featured Product') }}</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">{{ __('home.All') }}</li>
                            @foreach ($top_categories as $category)
                                <li data-filter=".{{ $category['name_' . app()->getLocale()] }}">
                                    {{ $category['name_' . app()->getLocale()] }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach ($featured as $variation)
                    <div
                        class="col-lg-3 col-md-6 col-sm-6 mix @foreach ($variation->product->categories as $category) {{ $category['name_' . app()->getLocale()] }} @endforeach">
                        <div class="product__discount__item">
                            <div class="product__discount__item__pic set-bg"
                                data-setbg="{{ isset($variation->product->images[0]->filename) ? url('storage/' . $variation->product->images[0]->filename) : asset('static/f/img/product/product-1.jpg') }}">
                                @isset($variation->discount)
                                    <div class="product__discount__percent">
                                        -{{ intval($variation->discount) }}%</div>
                                @endisset
                                <ul class="product__item__pic__hover">
                                    <li><a onclick="document.querySelector('#form-{{ $variation->id }}').submit()"><i
                                                class="fa fa-heart 
                                                @if (auth()->user() &&
                                                        auth()->user()->loved_products->contains($variation->product->id)) bg-red @endif
                                                "></i></a>
                                    </li>
                                    <form hidden id="form-{{ $variation->id }}"
                                        action="{{ route('front.store_love', ['product' => $variation->product->id]) }}"
                                        method="post">
                                        @csrf
                                    </form>
                                    {{-- <li><a href="#"><i class="fa fa-retweet"></i></a></li>  --}}
                                    <li><a
                                            href="{{ route('front.single', ['slug' => $variation->product->slug, 'var' => $variation->id]) }}"><i
                                                class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                                <h5><a
                                        href="{{ route('front.single', ['slug' => $variation->product->slug, 'var' => $variation->id]) }}">{{ $variation->product['name_' . app()->getLocale()] }}</a>
                                </h5>
                                <div class="product__item__price">
                                    {{ $variation->weight }} KG /
                                    ৳{{ $variation->price }}
                                    <span>৳{{ $variation->discounted_from_price }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Rtc Service Start -->

    <div class="py-5 service-12">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    {{-- <span class="badge badge-info rounded-pill px-3 py-1 font-weight-light">Service 12</span> --}}
                    <h3>Why Ready to Cook (RTC) Fish?</h3>
                    <br>
                    <h5 class="font-weight-light subtitle text-justify">We Bengali people can’t do even a single day without
                        fish. It is
                        very difficult, time-consuming, and tedious to prepare a whole fish ready to cook. In the
                        demographic and sociographic side, a new middle-class has emerged in Bangladesh in recent time who
                        are educated, work as employment positions or self-employed in the formal economy in the urban and
                        peri-urban areas of Bangladesh. </h5>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <h5 class="font-weight-medium">High-quality Fish</h5>
                            <p>Sourcing high-quality fish directly from farmer clusters, Fisherman.</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <h5 class="font-weight-medium">Cleaning & Processing</h5>
                            <p>Dressing and cutting into culturally inspired RTC shapes and packing.</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <h5 class="font-weight-medium">Affordable Price</h5>
                            <p>Affordable price for Dhaka, Khulna and other EPZ areas with low purchasing power and has no
                                storage facilities</p>
                        </div>
                        <div class="col-md-6 mt-3">
                            <h5 class="font-weight-medium">Warehouse and delivery</h5>
                            <p>Warehousing and delivering through a cool logistics system to the home and business consumers
                                through online. </p>
                        </div>
                        {{-- <div class="col-lg-12 my-4">
                            <a class="btn btn-info-gradiant btn-md border-0 text-white" href="#f12"><span>Learn
                                    More</span></a>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row wrap-service12">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 img-hover mb-4"><img
                                        src="{{ asset('static/f/img/product/discount/pd-1.jpg') }}"
                                        class="rounded img-shadow img-fluid" alt="wrapkit" /></div>
                                <div class="col-md-12 img-hover mb-4"><img
                                        src="{{ asset('static/f/img/product/discount/pd-1.jpg') }}"
                                        class="rounded img-shadow img-fluid" alt="wrapkit" /></div>
                            </div>
                        </div>
                        <div class="col-md-6 uneven-box">
                            <div class="row">
                                <div class="col-md-12 img-hover mb-4"><img
                                        src="{{ asset('static/f/img/product/discount/pd-1.jpg') }}"
                                        class="rounded img-shadow img-fluid" alt="wrapkit" /></div>
                                <div class="col-md-12 img-hover mb-4"><img
                                        src="{{ asset('static/f/img/product/discount/pd-1.jpg') }}"
                                        class="rounded img-shadow img-fluid" alt="wrapkit" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->

    @if (DB::table('offers')->count())
        <!-- Banner Begin -->
        <div class="banner">
            <div class="container">
                <div class="section-title">
                    <h2>Deal of the day</h2>
                </div>
                <div class="row">
                    @foreach (DB::table('offers')->orderBy('updated_at', 'desc')->get() as $item)
                        @if ($item->active)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="hero__item set-bg offer_banner "
                                    data-setbg="{{ url('storage/' . $item->image) }}">
                                    <div class="hero__text">
                                        <span>{{ App\Models\Category::where('id', $item->category_id)->first()['name_' . app()->getLocale()] }}</span>
                                        <h2>{{ collect($item)['heading_' . app()->getLocale()] }}</h2>
                                        <p>{{ collect($item)['sub_heading_' . app()->getLocale()] }}</p>
                                        <a href="{{ route('front.shop', ['category_id' => $item->category_id]) }}"
                                            class="primary-btn">SHOP NOW</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Banner End -->
    @endif

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Latest Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($latest as $item)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($item as $variation)
                                        <a href="{{ route('front.single', ['slug' => $variation->product->slug, 'var' => $variation->id]) }}"
                                            class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="/static/f/img/latest-product/lp-1.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $variation['name_' . app()->getLocale()] }}</h6>
                                                <span>৳{{ $variation->price }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Top Rated Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            @foreach ($top_rated as $item)
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($item as $variation)
                                        <a href="{{ route('front.single', ['slug' => $variation->product->slug, 'var' => $variation->id]) }}"
                                            class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="/static/f/img/latest-product/lp-1.jpg" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>{{ $variation['name_' . app()->getLocale()] }}</h6>
                                                <span>৳{{ $variation->price }}</span>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>Review Products</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>৳30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>৳30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>৳30.00</span>
                                    </div>
                                </a>
                            </div>
                            <div class="latest-prdouct__slider__item">
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-1.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>৳30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>৳30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>৳30.00</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->
@endsection
