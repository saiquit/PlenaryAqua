@extends('layouts.frontend.base')
@section('title')
    {{ $product->name_en }}
@endsection

@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="/static/f/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $product['name_' . app()->getLocale()] }}</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('front.home') }}">Home</a>
                            <a
                                href="{{ route('front.shop', ['category_id' => $product->categories[0]->id]) }}">{{ $product->categories[0]['name_' . app()->getLocale()] }}</a>
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
                <div class="row d-none @if ($var == $variation->id) d-flex @endif">
                    <div class="col-lg-6 col-md-6 ">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item">
                                <img class="product__details__pic__item--large"
                                    src="{{ isset($variation->product->images[0]->filename) ? url('storage/' . $variation->product->images[0]->filename) : asset('static/b/src/images/product-1.jpg') }}"
                                    alt="">
                            </div>
                            <div class="product__details__pic__slider owl-carousel">
                                @foreach ($variation->product->images as $image)
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
                                    @if ($item->district_id == session('district'))
                                        <a
                                            href="{{ route('front.single', ['slug' => $product->slug, 'var' => $item->id]) }}"><button
                                                type="button"
                                                class="btn btn-lg btn-outline-secondary text-uppercase mx-2
                                            @if ($var == $item->id) active @endif">
                                                {{ $item['name_' . app()->getLocale()] }}</button>
                                        </a>
                                    @endif
                                @endforeach
                            </div>

                            <form action="{{ route('cart.update', ['id' => $variation->id]) }}" method="post">
                                {{ csrf_field() }}
                                <div>
                                    <div class="py-3"></div>
                                    {{-- <h3>{{ $variation['name_' . app()->getLocale()] }}</h3> --}}

                                    <div class="product__details__price">
                                        @isset($variation->discounted_from_price)
                                            <sup style="text-decoration: line-through">
                                                ৳{{ $variation->discounted_from_price }}
                                            </sup>
                                        @endisset
                                        <span class="text-dark display-3"><b>
                                                ৳{{ $variation->price }}
                                            </b>
                                        </span>
                                    </div>
                                    <div class="product__details__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" readonly max="{{ $variation->stock }}"
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
                                            <span>{{ $variation->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                                                ({{ $variation->stock }})
                                            </span>
                                        </li>
                                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span>
                                        </li>
                                        <li><b>Net Weight</b> <span>{{ $variation->weight }} kg</span></li>
                                        <li><b>Gross Weight</b> <span>{{ $variation->gross_weight }} kg</span></li>
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
                                    <a class="nav-link active" href="" data-toggle="tab" data-target="tabs-1"
                                        role="tab" aria-selected="true">Description</a>
                                </li>
                                {{-- <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                            aria-selected="false">Information</a>
                                    </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="" data-target="tabs-3" role="tab"
                                        aria-selected="false">Reviews <span>({{ $product->comments->count() }})</span></a>
                                </li>
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
                                    </div> --}}
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <section class="content-item" id="comments">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @auth
                                                            @if (!$product->comments->contains('user_id', auth()->id()))
                                                                <form
                                                                    action="{{ route('front.store_comment', ['product_id' => $product->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <h3 class="pull-left">New Comment</h3>
                                                                    <button type="submit"
                                                                        class="btn btn-light pull-right">Submit</button>
                                                                    <fieldset>
                                                                        <div class="row">
                                                                            {{-- <div class="col-sm-3 col-lg-2 hidden-xs">
                                                                    <img class="img-responsive"
                                                                        src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                                        alt="">
                                                                </div> --}}
                                                                            <div class="form-group col-xs-12 col-md-12">
                                                                                <textarea class="form-control" id="message" placeholder="Your message" required="" name="content"></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                </form>
                                                            @endif
                                                        @endauth
                                                        @if ($product->comments)
                                                            <h3>{{ $product->comments->count() . ' ' . Str::plural('Comment', $product->comments->count()) }}
                                                            </h3>
                                                        @endif
                                                        @foreach ($product->comments as $comment)
                                                            <div class="media">
                                                                {{-- <a class="pull-left" href="#"><img class="media-object"
                                                                        src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                                                        alt=""></a> --}}
                                                                <div class="media-body">
                                                                    <h4 class="media-heading">{{ $comment->user->name }}
                                                                    </h4>
                                                                    <p>{{ $comment->comment }}</p>
                                                                    <ul
                                                                        class="list-unstyled list-inline media-detail pull-left">
                                                                        <li><i
                                                                                class="fa fa-calendar"></i>{{ $comment->created_at->format('d/m/y') }}
                                                                        </li>
                                                                        {{-- <li><i class="fa fa-thumbs-up"></i>13</li> --}}
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <h5>৳30.00</h5>
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
                            <h5>৳30.00</h5>
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
                            <h5>৳30.00</h5>
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
                            <h5>৳30.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@endsection

@push('css')
    <style>
        .content-item {
            padding: 30px 0;
            background-color: #FFFFFF;
        }

        .content-item.grey {
            background-color: #F0F0F0;
            padding: 50px 0;
            height: 100%;
        }

        .content-item h2 {
            font-weight: 700;
            font-size: 35px;
            line-height: 45px;
            text-transform: uppercase;
            margin: 20px 0;
        }

        .content-item h3 {
            font-weight: 400;
            font-size: 20px;
            color: #555555;
            margin: 10px 0 15px;
            padding: 0;
        }

        .content-headline {
            height: 1px;
            text-align: center;
            margin: 20px 0 70px;
        }

        .content-headline h2 {
            background-color: #FFFFFF;
            display: inline-block;
            margin: -20px auto 0;
            padding: 0 20px;
        }

        .grey .content-headline h2 {
            background-color: #F0F0F0;
        }

        .content-headline h3 {
            font-size: 14px;
            color: #AAAAAA;
            display: block;
        }


        #comments {
            /* box-shadow: 0 -1px 6px 1px rgba(0, 0, 0, 0.1); */
            background-color: #FFFFFF;
        }

        #comments form {
            margin-bottom: 30px;
        }

        #comments .btn {
            margin-top: 7px;
        }

        #comments form fieldset {
            clear: both;
        }

        #comments form textarea {
            height: 100px;
        }

        #comments .media {
            border: 1px dashed #DDDDDD;
            padding: 2px;
            margin: 0;
            box-shadow: 2px 5px 21px -13px;
            border-radius: 1rem;
        }

        #comments .media-body {
            padding: 1rem;
        }

        #comments .media>.pull-left {
            margin-right: 20px;
        }

        #comments .media img {
            max-width: 100px;
        }

        #comments .media h4 {
            margin: 0 0 10px;
        }

        #comments .media h4 span {
            font-size: 14px;
            float: right;
            color: #999999;
        }

        #comments .media p {
            margin-bottom: 15px;
            text-align: justify;
        }

        #comments .media-detail {
            margin: 0;
        }

        #comments .media-detail li {
            color: #AAAAAA;
            font-size: 12px;
            padding-right: 10px;
            font-weight: 600;
        }

        #comments .media-detail a:hover {
            text-decoration: underline;
        }

        #comments .media-detail li:last-child {
            padding-right: 0;
        }

        #comments .media-detail li i {
            color: #666666;
            font-size: 15px;
            margin-right: 10px;
        }
    </style>
@endpush
