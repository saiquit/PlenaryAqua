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
                <div class="col-lg-3 col-md-5" style="position: relative">
                    <div class="sidebar">
                        <div class="d-none d-md-block sidebar__item">
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
                        <div class="  d-block d-md-none sidebar__item">
                            <h4>Department</h4>
                            <form id="filter_dep_form" action="{{ route('front.shop') }}" method="get">
                                <div class="dep_sort">
                                    <select name="category_id">
                                        <option value="">Default</option>
                                        @foreach (request()->categories as $category)
                                            <option @selected(request()->query('category_id') == $category->id) value="{{ $category->id }}">
                                                {{ $category['name_' . app()->getLocale()] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class=" sidebar__item p-0">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="{{ intval(DB::table('variations')->where('district_id', session('district'))->min('price')) }}"
                                    data-max="{{ intval(DB::table('variations')->where('district_id', session('district'))->max('price')) }}">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input readonly type="text" value="{{ request()->query('minPrice') }}"
                                            id="minamount">
                                        <input readonly type="text" id="maxamount"
                                            value="{{ request()->query('maxPrice') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
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
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="carousel slide" data-ride="carousel" id="carousel_{{ $product->id }}"
                                    data-touch="true">
                                    <div class="carousel-inner">
                                        @foreach ($product->variations->where('district_id', session('district')) as $var_key => $variation)
                                            <div
                                                class="carousel-item @if ($loop->index == 0) active @endif {{ $var_key }}">
                                                <div class="product__discount__item ">
                                                    <div class="product__discount__item__pic set-bg"
                                                        data-setbg="{{ isset($variation->product->images[0]->filename) ? url('storage/' . $variation->product->images[0]->filename) : url('storage/default.jpg') }}">

                                                        @if ($variation->discount > 0)
                                                            <div class="product__discount__percent">
                                                                -{{ intval($variation->discount) }}%</div>
                                                        @endif
                                                        <ul class="product__item__pic__hover ">
                                                            <li data-toggle="tooltip" data-placement="top"
                                                                title="Add to Favorite.">
                                                                <a
                                                                    onclick="document.querySelector('#form-{{ $variation->id . $product->id }}').submit()"><i
                                                                        class="@if (auth()->user() &&
                                                                                auth()->user()->loved_products->contains($product->id)) icon_heart text-danger @else icon_heart_alt @endif"></i></a>
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
                                                            @if ($variation->discounted_from_price > 0)
                                                                <span>৳{{ $variation->discounted_from_price }}</span>
                                                            @endif
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
    <script type="text/javascript"
        src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.price-range').draggable();
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
            $('#filter_dep_form select').change(function(e) {
                e.preventDefault();
                var path = $(location).attr('href').split('?')[0];
                var params = {};
                location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(s, k, v) {
                    params[k] = v
                });
                params['category_id'] = $(this).val();
                var param_list = '';
                for (const key in params) {
                    if (Object.hasOwnProperty.call(params, key)) {
                        const element = params[key];
                        param_list += key + '=' + element + '&';
                    }
                }
                var newUrl = path + '?' + param_list;
                if ($(this).val().length) {
                    window.location.href = newUrl;
                }
            });


            var stickyOffset = $(".sidebar").offset().top;

            $(window).scroll(function() {
                var sticky = $(".sidebar"),
                    scroll = $(window).scrollTop();
                if (scroll >= stickyOffset) sticky.addClass("fixed");
                else sticky.removeClass("fixed");
            });
        });
    </script>
@endpush
