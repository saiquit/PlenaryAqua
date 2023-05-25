@extends('layouts.frontend.base')
@section('title')
    Cart
@endsection
@section('main')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('static/f/img/banner/banner-shop-green.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text black_heading_text">
                        <h2>Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('front.home') }}">Home</a>
                            <span>Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <div id="loading" class=" position-fixed" style="left: 50%;">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (session('cart.items') as $item)
                                    <tr id="{{ $item['id'] }}">
                                        <td class="shoping__cart__item">
                                            <img width="150"
                                                src="{{ isset($item->product->images[0]->filename) ? url('storage/' . $item->product->images[0]->filename) : asset('static/f/img/product/product-1.jpg') }}"
                                                alt="">
                                            <h5>{{ $item->product['name_' . app()->getLocale()] }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ৳{{ $item->price }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    {{-- <span class="dec qtybtn">-</span> --}}
                                                    <input max="{{ $item->stock }}" readonly data-id="{{ $item['id'] }}"
                                                        name="qty" type="text" value="{{ $item['qty'] }}">
                                                    {{-- <span class="inc qtybtn">+</span> --}}
                                                </div>
                                            </div>
                                            </form>
                                        </td>
                                        <td class="shoping__cart__total">
                                            ৳{{ $item['qty'] * $item->price }}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <form action="{{ route('cart.delete') }}" method="post">
                                                @csrf
                                                <input hidden type="text" name="id" value="{{ $item['id'] }}">
                                                <button type="submit" class="btn icon_close"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{ route('front.shop', []) }}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        {{-- <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form method="POST" action="{{ route('cart.discount') }}">
                                @csrf
                                <input name="code" type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>

                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Redeem points</h5>
                            <div class="d-flex justify-content-between">
                                <p><b>Current:</b> {{ auth()->user()->profile->point }}</p>
                                <p><b>Redeemable:</b> ৳{{ round(auth()->user()->profile->point / 100) }}</p>
                            </div>
                            @if (round(auth()->user()->profile->point / 100) >= 50)
                                <form method="POST" action="{{ route('cart.redeem') }}">
                                    @csrf
                                    <button type="submit" class="site-btn btn-block">Redeem
                                        points</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span id="sub_total">৳{{ session('cart.subTotal') }}</span></li>
                            @if (session('cart.discount'))
                                <li>Discount <span id="sub_total">- ৳{{ session('cart.discount') }}</span></li>
                            @endif
                            <li>Total <span
                                    id="total">৳{{ session('cart.subTotal') - session('cart.discount') }}</span></li>
                        </ul>
                        <a href="{{ route('front.checkout', []) }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#loading').hide();
            $('.pro-qty button').click(function(e) {
                $('.shoping-cart').css({
                    'opacity': .2,
                });
                $('#loading').show();
                e.preventDefault();
                var selectedInput = $(this).siblings('input');
                var oldVal = selectedInput.val();
                var id = selectedInput.data('id')
                var table_row = $(`tr#${id}`)
                var price = parseFloat(table_row.find('.shoping__cart__price').text().split('৳')[1])
                var total = table_row.find('.shoping__cart__total');
                var newVal;
                if ($(this).hasClass('dec')) {
                    newVal = parseInt(oldVal) - 1;
                } else {
                    newVal = parseInt(oldVal) + 1
                }
                total.text('৳' + newVal * price)
                $.post("{{ route('cart.update') }}", {
                        id,
                        qty: newVal,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    function(data, textStatus, jqXHR) {
                        $('#sub_total').text('৳' + data.subTotal);
                        $('#total').text('৳' + data.total);
                        $('.shoping-cart').css({
                            'opacity': 1
                        });
                        if (newVal <= 0) {
                            $(`tr#${id}`).hide();
                        }
                        if (!Object.keys(data.cart).length) {
                            window.location.href = '/'
                        }
                        $('#loading').hide();
                    }
                );

            });
        });
    </script>
@endpush
