@extends('layouts.frontend.base')

@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/static/f/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product['name_' . app()->getLocale()] }}</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">{{ $product->categories[0]['name_' . app()->getLocale()] }}</a>
                            <span>{{ $product['name_' . app()->getLocale()] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            @foreach ($product->variations as $variation)
                @if ($variation->current_district->count())
                    <div class="row d-none @if ($var == $variation->id) d-flex @endif">
                        <div class="col-lg-6 col-md-6 ">
                            <div class="product__details__pic">
                                <div class="product__details__pic__item">
                                    <img class="product__details__pic__item--large"
                                        src="{{ isset($variation->images[0]->filename) ? url('storage/' . $variation->images[0]->filename) : null }}"
                                        alt="">
                                </div>
                                <div class="product__details__pic__slider owl-carousel">
                                    @foreach ($variation->images as $image)
                                        <img data-imgbigurl="{{ url('storage/' . $image->filename) }}"
                                            src="{{ url('storage/' . $image->filename) }}" alt="">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="product__details__text">
                                <div class="btn-group" role="group" aria-label="">
                                    @foreach ($product->variations as $item)
                                        @if ($item->districts->find(session('district')))
                                            <a
                                                href="{{ route('front.single', ['slug' => $product->slug, 'var' => $item->id]) }}"><button
                                                    type="button"
                                                    class="btn btn-lg btn-outline-secondary text-uppercase mx-2
                                            @if ($var == $item->id) active @endif">
                                                    {{ $item->weight }}KG</button>
                                            </a>
                                        @endif
                                    @endforeach
                                </div>

                                <form action="{{ route('cart.update', ['id' => $variation->id]) }}" method="post">
                                    @csrf
                                    <div>
                                        <h3>{{ $variation['name_' . app()->getLocale()] }}</h3>

                                        <div class="product__details__price">
                                            @isset($variation->current_district[0]->pivot->discounted_from_price)
                                                <sup style="text-decoration: line-through">
                                                    ${{ $variation->current_district[0]->pivot->discounted_from_price }}
                                                </sup>
                                            @endisset
                                            ${{ $variation->current_district[0]->pivot->price }}
                                        </div>
                                        <div class="product__details__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" readonly
                                                        max="{{ $variation->current_district[0]->pivot->stock }}"
                                                        value="{{ isset(session('cart.items')[$variation->id]['qty']) ? session('cart.items')[$variation->id]['qty'] : 0 }}"
                                                        name="qty" />
                                                </div>
                                            </div>
                                        </div>
                                        <button @disabled(!isset(session('cart.items')[$variation->id]['qty'])) type="submit" class="btn primary-btn">ADD TO
                                            CARD</button>
                                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                                        <ul>
                                            <li><b>Availability</b>
                                                <span>{{ $variation->current_district[0]->pivot->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                                    ({{ $variation->current_district[0]->pivot->stock }})
                                                </span>
                                            </li>
                                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span>
                                            </li>
                                            <li><b>Weight</b> <span>{{ $variation->weight }} kg</span></li>
                                            <li><b>Share on</b>
                                                <div class="share">
                                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="product__details__tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                            aria-selected="true">Description</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                            aria-selected="false">Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                            aria-selected="false">Reviews <span>(1)</span></a>
                                    </li> --}}
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                        <div class="product__details__tab__desc">
                                            <h6>Products Infomation</h6>
                                            <p>{{ $variation['desc_' . app()->getLocale()] }}</p>
                                        </div>
                                    </div>
                                    {{-- <div class="tab-pane" id="tabs-2" role="tabpanel">
                                        <div class="product__details__tab__desc">
                                            <h6>Products Infomation</h6>
                                            <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                                Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                                Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                                sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                                eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                                Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                                sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                                diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                                ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                                Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                                Proin eget tortor risus.</p>
                                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                                ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                                elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                                porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                                nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tabs-3" role="tabpanel">
                                        <div class="product__details__tab__desc">
                                            <h6>Products Infomation</h6>
                                            <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                                Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                                Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                                sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                                eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                                Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                                sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                                diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                                ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                                Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                                Proin eget tortor risus.</p>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/static/f/img/product/product-1.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/static/f/img/product/product-2.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/static/f/img/product/product-3.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="/static/f/img/product/product-7.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection
