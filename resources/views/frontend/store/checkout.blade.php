@extends('layouts.frontend.base')
@push('js')
    @vite(['resources/sass/front.scss'])
@endpush
@section('main')
    <section class="breadcrumb-section set-bg" data-setbg="/static/f/img/breadcrumb.jpg"
        style="background-image: url(/static/f/img/breadcrumb.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your
                        code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing/Shipping Details</h4>
                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input
                                            value="@auth {{ auth()->user()->profile->first_name }} @else {{ old('first_name') }} @endauth"
                                            name="first_name" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input
                                            value="@auth {{ auth()->user()->profile->last_name }} @else {{ old('last_name') }} @endauth"
                                            name="last_name" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input readonly type="text" value="Bangladesh">
                            </div>
                            <div class="checkout__input">
                                <p>District/City<span>*</span></p>
                                <select name="district" class="w-100 wide mb-3" id="">
                                    <option disabled selected value>None</option>
                                    <option @selected(session('district') == 1) value="1">Dhaka</option>
                                    <option @selected(session('district') == 2) value="2">Khulna</option>
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Upazila/Thana<span>*</span></p>
                                <select name="upazila" class="w-100 wide mb-3" id="">
                                    <option disabled selected value="">Select a District</option>
                                    @foreach (DB::table('delivery')->get() as $item)
                                        @if ($item->district_id == session('district'))
                                            <option value="{{ $item->id }}">{{ $item->name_en }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="address" id="address" placeholder="Street Address"
                                    class="checkout__input__add">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input readonly name="phone" value="@auth {{ auth()->user()->phone }} @endauth"
                                            placeholder="Phone Number; e.g. 017...." type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input readonly name="email" value="@auth {{ auth()->user()->email }} @endauth"
                                            placeholder="Email Address; e.g. email@email.com" type="email">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input name="note" type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total ৳</span></div>
                                <ul>
                                    @foreach (session('cart.items') as $item)
                                        <li>{{ $item['name_' . app()->getLocale()] }} x <b>{{ $item->qty }}</b>
                                            <span>{{ $item->get_price() * $item->qty }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span
                                        id="sub_total">{{ session('cart.subTotal') }}</span>
                                </div>
                                <div class="checkout__order__subtotal">Delivery Cost <span id="delivery_cost"></span>
                                </div>
                                <div class="checkout__order__total">Total <span id="total_cost"></span></div>
                                <h5><b>Choose a Payment method</b></h5>
                                <section class="payment mt-5">
                                    <div>
                                        <input type="radio" id="control_01" name="pay" value="bkash" checked>
                                        <label for="control_01">
                                            <p>Bkash</p>
                                            <img src="https://logos-download.com/wp-content/uploads/2022/01/BKash_Logo_icon-700x662.png"
                                                width="80" alt="">
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" id="control_02" name="pay" value="nagad">
                                        <label for="control_02">
                                            <p>Nagad</p>
                                            <img src="https://logos-download.com/wp-content/uploads/2022/01/Nagad_Logo_full-498x700.png"
                                                width="80" alt="">
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" id="control_03" name="pay" value="cod">
                                        <label for="control_03">
                                            <p>Cash of delivery</p>
                                            <img src="https://icon-library.com/images/cash-on-delivery-icon/cash-on-delivery-icon-13.jpg"
                                                width="80" alt="" srcset="">
                                        </label>
                                    </div>

                                </section>
                                <button id="order_btn" type="submit" disabled class="btn btn-primary">PLACE
                                    ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection


@push('js')
    <script>
        $(function() {
            var upazilas = @js(DB::table('delivery')->get());
            $('select[name="district"]').change(function(e) {
                e.preventDefault();
                var selectedUpazilas = upazilas.filter(item => item.district_id == $(this).val());
                var selectUpazilaText = '';
                selectedUpazilas.forEach(element => {
                    selectUpazilaText +=
                        `<option value="${element.id}">${element.name_en}</option>`;
                });

                $('select[name="upazila"]').empty().append(
                    '<option disabled selected value="">Select a Upazila</option>' + selectUpazilaText);
                $('select').niceSelect('update');
            });

            $('select[name="upazila"]').change(function(e) {
                e.preventDefault();
                var upazilas = @js(DB::table('delivery')->get());
                var selectedUpazila = upazilas.find(item => item.id == $(this).val());

                $('#delivery_cost').text(selectedUpazila.cost)
                var subTotal = parseFloat($('#sub_total').text());
                $('#total_cost').text(subTotal + parseFloat(selectedUpazila.cost))
                $('#order_btn').attr('disabled', false);
            });


            var availableTags = [
                "Batiaghata", "Dacope", "Dumuria", "Dighalia", "Koyra", "Paikgachha", "Phultala", "Rupsha",
                "Terokhada", "Daulatpur Thana", "Khalishpur Thana", "Khan Jahan Ali Thana", "Kotwali Thana",
                "Sonadanga Thana", "Harintana Thana", "Dhamrai", "Dohar", "Keraniganj", "Nawabganj", "Savar",
                "Tejgaon Circle", "CGS Colony", "Guljan City", "Khan Jahan Ali", "Khorshed Nagar",
                "Md. Aminul Hoque", "Shaikh Bari", "Bagmara", "Baliadanga", "Banorgati", "Basupara",
                "Batiaghata", "Charabati", "Chhoto Boyra", "Denarabad", "Dubi", "Gallamari", "Gangarampur",
                "Goborchaka", "Horintana", "Jora Gate", "Kholabaria", "Khulna", "Khulna University Gate",
                "Labanchara", "Mathavanga", "Mohammad Nagar", "Nij Khamar", "Nirala", "Roypara", "Sachibunia",
                "Surkhali", "Tetultola", "Thikrabad", "Tootpara", "sadar", "Road", "Street"
            ];
            $('#address').autocomplete({
                source: availableTags
            });

        });
    </script>
@endpush
