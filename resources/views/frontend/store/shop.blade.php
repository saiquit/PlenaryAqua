@extends('layouts.frontend.base')
@section('title')
    Store
@endsection

@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('static/f/img/banner/banner-shop-green.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text black_heading_text">
                        <h2>Plenary Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('front.home') }}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                @foreach (request()->categories as $category)
                                    <li class="@if (request()->query('category_id') == $category->id) active @endif">
                                        <a
                                            href="{{ route('front.shop', array_merge(array_diff($_GET, ['page']), ['category_id' => $category->id])) }}">{{ $category['name_' . app()->getLocale()] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="range-slider">
                                <div id="slider_thumb" class="range-slider_thumb"></div>
                                <div class="range-slider_line">
                                    <div id="slider_line" class="range-slider_line-fill"></div>
                                </div>
                                <input id="slider_input" class="range-slider_input" type="range" name="maxPrice"
                                    value="{{ request()->query('maxPrice') ? request()->query('maxPrice') : '0' }}"
                                    min="{{ DB::table('variations')->min('price') }}"
                                    max="{{ DB::table('variations')->max('price') }}">
                            </div>
                        </div>
                        {{-- <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div> --}}
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Top Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    {{-- @if ($top_rated->count())
                                        @foreach ($top_rated as $item)
                                            <div class="latest-prdouct__slider__item">
                                                @foreach ($item as $variation)
                                                    <a href="{{ route('front.single', ['slug' => $variation->product->slug, 'var' => $variation->id]) }}"
                                                        class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img src="{{ isset($variation->product->images[0]->filename) ? url('storage/' . $variation->product->images[0]->filename) : asset('static/f/img/product/product-1.jpg') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6>{{ $variation['name_' . app()->getLocale()] }}</h6>
                                                            <span>৳{{ $variation->price }}</span>
                                                        </div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    {{-- <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="/static/f/img/product/discount/pd-1.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="/static/f/img/product/discount/pd-2.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Vegetables</span>
                                            <h5><a href="#">Vegetables’package</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="/static/f/img/product/discount/pd-3.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Mixed Fruitss</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="/static/f/img/product/discount/pd-4.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="/static/f/img/product/discount/pd-5.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="/static/f/img/product/discount/pd-6.jpg">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>Dried Fruit</span>
                                            <h5><a href="#">Raisin’n’nuts</a></h5>
                                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <form id="filter_sort_form" action="{{ route('front.shop') }}" method="get">
                                    <div class="filter__sort">
                                        <span>Sort By</span>
                                        <select name="sort">
                                            <option value="">Default</option>
                                            <option @selected(request()->query('sort') == 'price_asc') value="price_asc">Price Low to High
                                            </option>
                                            <option @selected(request()->query('sort') == 'price_desc') value="price_desc">Price High to Low
                                            </option>
                                            <option @selected(request()->query('sort') == 'weight_asc') value="weight_asc">Weight Low to High
                                            </option>
                                            <option @selected(request()->query('sort') == 'weight_desc') value="weight_desc">Weight High to Low
                                            </option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $products->total() }}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                {{-- <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        @foreach ($products as $key => $product)
                            <div class="col-lg-4 col-md-6 col-sm-6{{ $product->id }}">
                                <div class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner ">
                                        @foreach ($product->variations->where('district_id', session('district')) as $var_key => $variation)
                                            <div
                                                class="carousel-item @if ($loop->index == 0) active @endif {{ $var_key }}">
                                                <div class="product__discount__item ">
                                                    <div class="product__discount__item__pic set-bg"
                                                        data-setbg="{{ $product->images->count() ? url('storage/' . $product->images[0]->filename) : asset('static/f/img/product/product-1.jpg') }}">

                                                        @isset($variation->discount)
                                                            <div class="product__discount__percent">
                                                                -{{ intval($variation->discount) }}%</div>
                                                        @endisset
                                                        <ul class="product__item__pic__hover ">
                                                            <li data-toggle="tooltip" data-placement="top"
                                                                title="Add to Favorite.">
                                                                <a
                                                                    onclick="document.querySelector('#form-{{ $variation->id . $product->id }}').submit()"><i
                                                                        class="fa fa-heart @if (auth()->user() &&
                                                                                auth()->user()->loved_products->contains($product->id)) text-danger @endif"></i></a>
                                                            </li>
                                                            <form hidden id="form-{{ $variation->id . $product->id }}"
                                                                action="{{ route('front.store_love', ['product' => $product->id]) }}"
                                                                method="post">
                                                                @csrf
                                                            </form>
                                                            {{-- <li class="var_change" data-var="{{ $key }}"
                                                                data-placement="top" title="variation"><a href="#"><i
                                                                        class="fa fa-retweet"></i></a>
                                                            </li> --}}
                                                            <li data-placement="top" title="Buy">
                                                                @if (intval($variation->stock) > 0)
                                                                    <a
                                                                        href="{{ route('front.single', ['slug' => $product->slug, 'var' => $variation->id]) }}"><i
                                                                            class="fa fa-shopping-cart"></i></a>
                                                                @else
                                                                    <p class="p-1 border-rounded bg-warning text-white">Out
                                                                        of Stock</p>
                                                                @endif
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="product__discount__item__text">
                                                        <h5>
                                                            <a
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

                            </div>
                        @endforeach
                    </div>
                    <div class="custom_pagination">
                        {{ $products->appends($_GET)->links('pagination::bootstrap-5') }}
                    </div>
                    {{-- <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#filter_sort_form select').change(function(e) {
                e.preventDefault();
                var path = $(location).attr('href').split('?')[0];
                var params = {};
                location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(s, k, v) {
                    params[k] = v
                });
                params['sort'] = $(this).val();
                var param_list = '';
                for (const key in params) {
                    if (Object.hasOwnProperty.call(params, key)) {
                        const element = params[key];
                        param_list += key + '=' + element + '&';
                    }
                }
                var newUrl = path + '?' + param_list;
                window.location.href = newUrl;
            });
            $('.price_car').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            })

        });
    </script>
@endpush
