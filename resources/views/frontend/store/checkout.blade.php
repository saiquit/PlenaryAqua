@extends('layouts.frontend.base')
@section('title')
    Checkout
@endsection

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
                            <a href="{{ route('front.home') }}">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your
                        code
                    </h6>
                </div>
            </div> --}}
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
                                        <input placeholder="First Name"
                                            @isset(auth()->user()->profile->first_name)
                                            value="{{ auth()->user()->profile->first_name }}"
                                                @else
                                                value="{{ old('first_name') }}"
                                            @endisset
                                            name="first_name" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input placeholder="Last Name"
                                            @isset(auth()->user()->profile->last_name)
                                        value="{{ auth()->user()->profile->last_name }}"
                                            @else
                                            value="{{ old('last_name') }}"
                                        @endisset
                                            name="last_name" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input readonly type="text" value="Bangladesh">
                            </div>
                            <div class="checkout__input">
                                <div class="d-flex justify-content-between">
                                    <p>Address<span>*</span></p>
                                    <div class="address_nav">
                                        @if (!auth()->user()->profile->addresses->contains('active', '1'))
                                            <p class="text-danger">Select/Create a address*</p>
                                        @endif
                                        @isset(auth()->user()->profile->addresses)
                                            <a class="btn btn-primary text-light" data-toggle="modal"
                                                data-target="#update_address">Change Shipping Address</a>
                                        @endisset
                                        <a class="btn btn-secondary text-light" data-toggle="modal"
                                            data-target="#createAddress" class="">Create</a>
                                    </div>
                                </div>
                                @isset(auth()->user()->profile->addresses)
                                    @foreach (auth()->user()->profile->addresses as $address)
                                        @if ($address->active)
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Type: </span>
                                                    <span>
                                                        <div
                                                            class="badge text-capitalize @switch($address->type) @case('home')badge-primary @break @case('work')badge-secondary @break @default badge-info @endswitch">
                                                            {{ $address->type }}
                                                        </div>
                                                    </span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>District: </span>
                                                    <span>{{ collect(DB::table('districts')->find($address->district))['name_' . app()->getLocale()] }}</span>
                                                    <input type="text" name="district" value="{{ $address->district }}"
                                                        hidden>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Upazila: </span>
                                                    <span>{{ collect(DB::table('delivery')->find($address->upazila))['name_' . app()->getLocale()] }}</span>
                                                    <input type="text" name="upazila" value="{{ $address->upazila }}"
                                                        hidden>

                                                </li>
                                                <li class="list-group-item d-flex justify-content-between">
                                                    <span>Location: </span>
                                                    <span>{{ $address->location }}</span>
                                                    <input type="text" name="address" value="{{ $address->location }}"
                                                        hidden>
                                                </li>
                                            </ul>
                                        @endif
                                    @endforeach
                                @endisset
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
                                    @foreach (session('cart.items') as $variation)
                                        <li>{{ $variation['name_' . app()->getLocale()] }} x <b>{{ $variation->qty }}</b>
                                            <span>{{ $variation->price * $variation->qty }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span
                                        id="sub_total">{{ session('cart.subTotal') }}</span>
                                </div>
                                <div class="checkout__order__subtotal">+Delivery Cost
                                    <span id="delivery_cost">
                                        @if (auth()->user()->profile->addresses->contains('active', 1))
                                            {{ DB::table('delivery')->where(
                                                    'id',
                                                    auth()->user()->profile->addresses->where('active', 1)->first()->id,
                                                )->first()->cost }}
                                        @else
                                            0
                                        @endif
                                    </span>
                                </div>
                                @if (session('cart.discount'))
                                    <div class="checkout__order__subtotal text-danger">-Discount<span
                                            id="discount">{{ session('cart.discount') }}</span>
                                    </div>
                                @endif
                                @if (auth()->user()->profile->addresses->contains('active', 1))
                                    <div class="checkout__order__total">Total
                                        <span id="total_cost">
                                            {{ session('cart.subTotal') +
                                                floatval(
                                                    DB::table('delivery')->where(
                                                            'id',
                                                            auth()->user()->profile->addresses->where('active', 1)->first()->id,
                                                        )->first()->cost,
                                                ) -
                                                session('cart.discount') }}
                                        </span>
                                    </div>
                                @endif
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

    <!-- Select Modal -->
    <div class="modal fade" id="update_address" tabindex="-1" aria-labelledby="update_address_Label"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('front.address_update', ['profile' => auth()->user()->profile->id]) }}"
                method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="update_address_Label">Select A Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach (auth()->user()->profile->addresses as $address)
                            <div class="custom-control custom-radio">
                                <input value="{{ $address->id }}" type="radio" @checked($address->active)
                                    id="{{ $address->id }}" name="address" class="custom-control-input">
                                <label class="custom-control-label" for="{{ $address->id }}">
                                    <span>{{ $address->location }},{{ collect(DB::table('delivery')->find($address->upazila))['name_' . app()->getLocale()] }}
                                        ,{{ collect(DB::table('districts')->find($address->district))['name_' . app()->getLocale()] }},
                                        <span class="badge badge-primary">{{ $address->type }}</span>
                                    </span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- Create_address_model --}}
    <div class="modal fade" id="createAddress" tabindex="-1" aria-labelledby="createAddressLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('front.store_address') }}" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createAddressLabel">Create A Address</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="checkout__input">
                            <p>Type<span>*</span></p>
                            <select name="type" class="w-100 wide mb-3" id="">
                                <option value="home">
                                    Home</option>
                                <option value="work">
                                    Work</option>
                                <option value="others">
                                    Other</option>
                            </select>
                        </div>
                        <div class="checkout__input">
                            <p>District/City<span>*</span></p>
                            <select name="district" class="w-100 wide mb-3" id="">
                                <option disabled selected value>None</option>
                                <option @selected(session('district') == 1) value="1">
                                    Dhaka</option>
                                <option @selected(session('district') == 2) value="2">
                                    Khulna</option>
                            </select>
                        </div>
                        <div class="checkout__input">
                            <p>Upazila/Thana<span>*</span></p>
                            <select name="upazila" class="w-100 wide mb-3" id="">
                                <option disabled selected value="">Select a
                                    Upzila/Thaka</option>
                                @foreach (DB::table('delivery')->get() as $item)
                                    @if ($item->district_id == session('district'))
                                        <option value="{{ $item->id }}">
                                            {{ $item->name_en }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input type="text" name="address" id="address" placeholder="Street Address"
                                class="checkout__input__add">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(function() {
            @if (auth()->user()->profile->addresses->where('active', 1)->count())
                $('#order_btn').attr('disabled', false);
            @endif
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
                $('#total_cost').text(subTotal + parseFloat(selectedUpazila.cost) - parseFloat($(
                    '#discount').text()))
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
