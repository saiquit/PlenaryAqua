@extends('layouts.frontend.base')
@section('main')
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach ($all_categories as $category)
                        <div class="col-lg-3">
                            <div class="categories__item set-bg"
                                data-setbg="/static/f/img/categories/cat-{{ rand(1, 5) }}.jpg">
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
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
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
                    @if ($variation->current_district->count())
                        <div
                            class="col-6 col-lg-3 col-md-4  mix @foreach ($variation->product->categories as $category)
                            {{ $category['name_' . app()->getLocale()] }} @endforeach ">
                            <div class="product__discount__item">
                                <div class="product__discount__item__pic set-bg"
                                    data-setbg="/static/f/img/product/product-{{ ($variation->product_id % 2) + 1 }}.jpg">
                                    <div class="product__discount__percent">
                                        -{{ $variation->current_district[0]->pivot->discount }}%</div>
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
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
                                        ${{ $variation->current_district[0]->pivot->price }}
                                        <span>${{ $variation->current_district[0]->pivot->discounted_from_price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="/static/f/img/banner/banner-1.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="/static/f/img/banner/banner-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

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
                                                <span>${{ $variation->get_price() }}</span>
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
                                                <span>${{ $variation->get_price() }}</span>
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
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
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
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-2.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
                                    </div>
                                </a>
                                <a href="#" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="/static/f/img/latest-product/lp-3.jpg" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>Crab Pool Security</h6>
                                        <span>$30.00</span>
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
