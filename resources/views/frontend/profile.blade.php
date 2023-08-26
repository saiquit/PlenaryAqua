@extends('layouts.frontend.base')
@section('title')
    Profile
@endsection
@push('css')
    <style>
        .modal-body {
            background-color: #fff;
            border-color: #fff;

        }

        .close {
            color: #000;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }


        .theme-color {

            color: #1a632d;
        }

        hr.new1 {
            border-top: 2px dashed #fff;
            margin: 0.4rem 0;
        }

        .hh-grayBox {
            background-color: #F8F8F8;
            margin-bottom: 20px;
            padding: 35px;
            margin-top: 20px;
        }

        .pt45 {
            padding-top: 45px;
        }

        .order-tracking {
            text-align: center;
            width: 33.33%;
            position: relative;
            display: block;
        }

        .order-tracking .is-complete {
            display: block;
            position: relative;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            border: 0px solid #AFAFAF;
            background-color: #f7be16;
            margin: 0 auto;
            transition: background 0.25s linear;
            -webkit-transition: background 0.25s linear;
            z-index: 2;
        }

        .order-tracking .is-complete:after {
            display: block;
            position: absolute;
            content: '';
            height: 14px;
            width: 7px;
            top: -2px;
            bottom: 0;
            left: 5px;
            margin: auto 0;
            border: 0px solid #AFAFAF;
            border-width: 0px 2px 2px 0;
            transform: rotate(45deg);
            opacity: 0;
        }

        .order-tracking.completed .is-complete {
            border-color: #27aa80;
            border-width: 0px;
            background-color: #27aa80;
        }

        .order-tracking.completed .is-complete:after {
            border-color: #fff;
            border-width: 0px 3px 3px 0;
            width: 7px;
            left: 11px;
            opacity: 1;
        }

        .order-tracking p {
            color: #A4A4A4;
            font-size: 16px;
            margin-top: 8px;
            margin-bottom: 0;
            line-height: 20px;
        }

        .order-tracking p span {
            font-size: 14px;
        }

        .order-tracking.completed p {
            color: #000;
        }

        .order-tracking::before {
            content: '';
            display: block;
            height: 3px;
            width: calc(100% - 40px);
            background-color: #f7be16;
            top: 13px;
            position: absolute;
            left: calc(-50% + 20px);
            z-index: 0;
        }

        .order-tracking:first-child:before {
            display: none;
        }

        .order-tracking.completed:before {
            background-color: #27aa80;
        }
    </style>
@endpush
@section('main')
    <section class="py-5 my-5">
        <div class="container px-5">
            <div class="bg-white shadow rounded-lg row">
                <div class="col-12 col-md-3 profile-tab-nav border-right">
                    <div class="p-4">
                        <h4 class="text-center">Point: {{ $profile->point }}</h4>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active show" id="account-tab" data-toggle="pill" href="#account" role="tab"
                            aria-controls="account" aria-selected="true">
                            <i class="fa fa-home text-center mr-1"></i>
                            My Account
                        </a>
                        <a class="nav-link" id="address-tab" data-toggle="pill" href="#address" role="tab"
                            aria-controls="address" aria-selected="true">
                            <i class="fa fa-home text-center mr-1"></i>
                            Address Book
                        </a>
                        <a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab"
                            aria-controls="security" aria-selected="false">
                            <i class="fa fa-user text-center mr-1"></i>
                            Security
                        </a>
                        <a class="nav-link" id="order-tab" data-toggle="pill" href="#order" role="tab"
                            aria-controls="order" aria-selected="false">
                            <i class="fa fa-tv text-center mr-1"></i>
                            Orders
                        </a>
                        <a class="nav-link" id="notification-tab" data-toggle="pill" href="#notification" role="tab"
                            aria-controls="notification" aria-selected="false">
                            <i class="fa fa-bell text-center mr-1"></i>
                            Notification
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-9 tab-content p-4 p-md-5 w-100" id="v-pills-tabContent">
                    <div class="tab-pane fade active show" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <form action="{{ route('front.update_profile') }}" method="post">
                            @csrf

                            <h3 class="mb-4">Account Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" name="first_name"
                                            value="{{ auth()->user()->profile->first_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="last_name"
                                            value="{{ auth()->user()->profile->last_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone number</label>
                                        <input type="text" class="form-control" readonly
                                            value="{{ auth()->user()->phone }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Bio</label>
                                        <textarea class="form-control" rows="4" name="bio">{{ auth()->user()->profile->bio }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <p>District/City<span>*</span></p>
                                    <select name="district" class="w-100 wide mb-3" id="">
                                        <option disabled selected value>None</option>
                                        <option @selected(auth()->user()->profile->district == 1) value="1">Dhaka</option>
                                        <option @selected(auth()->user()->profile->district == 2) value="2">Khulna</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <p>Upazila/Thana<span>*</span></p>
                                    <select name="upazila" class="w-100 wide mb-3" id="">
                                        <option disabled selected value="">Select a District</option>
                                        @foreach (DB::table('delivery')->get() as $item)
                                            <option @selected(intval(auth()->user()->profile->upazila) == intval($item->id)) value="{{ $item->id }}">
                                                {{ $item->name_en }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <p>Address<span>*</span></p>
                                    <input type="text" name="address" value="{{ auth()->user()->profile->address }}"
                                        id="address" placeholder="Street Address" class="form-control">
                                </div> --}}
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button class="btn btn-light">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                        <h3 class="mb-4">Address Book</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <form action="{{ route('front.store_address') }}" method="post">
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
                                    <button type="submit" class="btn btn-primary">Update / Create New</button>

                                </form>
                            </div>
                            <div class="col-md-8">
                                <h4>Previously Added</h4>
                                @if (auth()->user()->profile->addresses->count())
                                    @foreach (auth()->user()->profile->addresses as $key => $address)
                                        <ul class="list-group my-2">
                                            {{-- <li class="list-group-item d-flex justify-content-between">
                                                <span>ID: </span>
                                                <span>{{ $key + 1 }}</span>
                                            </li> --}}
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
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Upazila: </span>
                                                <span>{{ collect(DB::table('delivery')->find($address->upazila))['name_' . app()->getLocale()] }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Location: </span>
                                                <span>{{ $address->location }}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span> </span>
                                                <span>
                                                    <form
                                                        action="{{ route('front.address_delete', ['address' => $address->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit">Delete</button>
                                                    </form>
                                                </span>
                                            </li>
                                        </ul>
                                    @endforeach
                                @endif

                            </div>

                        </div>

                    </div>
                    <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                        <h3 class="mb-4">Security Settings</h3>
                        <div class="row">
                            <a href="{{ route('password.reset', ['token' => csrf_token()]) }}">
                                <button class="btn btn-primary">Update password</button>
                            </a>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="order" role="tabpanel" aria-labelledby="order-tab">
                        <h3 class="mb-4">Order Settings</h3>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="header-title pb-3 mt-0">Payments</h5>
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead>
                                                    <tr class="align-self-center">
                                                        <th>Order ID</th>
                                                        <th>Product Name</th>
                                                        <th>Order Date</th>
                                                        <th>Amount</th>
                                                        <th>Order Status</th>
                                                        <th>Shipping</th>
                                                        <th>Show Items</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (Auth::user()->orders as $order)
                                                        <tr>
                                                            <td>#{{ $order->order_id }}
                                                            </td>
                                                            <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                            <td>৳{{ $order->total }}</td>
                                                            <td>
                                                                @if ($order->status == 'pending')
                                                                    <span
                                                                        class="badge badge-warning badge-boxed badge-soft-warning">{{ $order->status }}</span>
                                                                @elseif ($order->status == 'accepted')
                                                                    <span
                                                                        class="badge badge-success badge-boxed badge-soft-success">{{ $order->status }}</span>
                                                                @elseif ($order->status == 'cancled')
                                                                    <span
                                                                        class="badge badge-danger badge-boxed badge-soft-danger">{{ $order->status }}</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-info badge-boxed badge-soft-info">{{ $order->status }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge @switch($order->shipping_status) @case('pending') badge-info @break @case('shipping') badge-warning @break @case('shipped') badge-warning @break @default badge-success @endswitch badge-boxed badge-soft-warning">{{ $order->payment }}</span>
                                                            </td>
                                                            <td>
                                                                @if ($order->status == 'canceled')
                                                                    <button class="btn btn-danger"
                                                                        disabled>Canceled</button>
                                                                @else
                                                                    <button @disabled($order->status == 'canceled')
                                                                        class="btn btn-primary" data-toggle="modal"
                                                                        data-target="#vars_{{ $order->id }}"><i
                                                                            class="icon_bag_alt"></i></button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <div class="modal fade" id="vars_{{ $order->id }}"
                                                            tabindex="-1" role="dialog"
                                                            aria-labelledby="vars_{{ $order->id }}_Label"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body ">
                                                                        <div class="text-right"> <i
                                                                                class="fa fa-close close"
                                                                                data-dismiss="modal"></i> </div>

                                                                        <div class="px-4 py-5">
                                                                            <h5 class="text-uppercase">
                                                                                {{ $order->first_name . ' ' . $order->last_name }}
                                                                            </h5>
                                                                            <h4 class="mt-5 theme-color mb-5">Thanks for
                                                                                your order</h4>

                                                                            <span class="theme-color">Payment
                                                                                Summary</span>
                                                                            <div class="mb-3">
                                                                                <hr class="new1">
                                                                            </div>
                                                                            @foreach ($order->variations as $variation)
                                                                                <div
                                                                                    class="d-flex justify-content-between">
                                                                                    <span
                                                                                        class="font-weight-bold">{{ $variation->product->name_en }}(Qty:{{ $variation->pivot->qty }})</span>
                                                                                    <span
                                                                                        class="text-muted">৳{{ $variation->pivot->qty * $variation->price }}</span>
                                                                                </div>
                                                                            @endforeach
                                                                            <div class="d-flex justify-content-between">
                                                                                <small>Sub total</small>
                                                                                <small>৳{{ $order->sub_total }}.00</small>
                                                                            </div>
                                                                            <div class="d-flex justify-content-between">
                                                                                <small>Shipping</small>
                                                                                <small>৳{{ $order->dl_total }}</small>
                                                                            </div>
                                                                            @if ($order->discount)
                                                                                <div
                                                                                    class="d-flex justify-content-between">
                                                                                    <small>Discount</small>
                                                                                    <small>৳{{ $order->discount }}</small>
                                                                                </div>
                                                                            @endif
                                                                            <div
                                                                                class="d-flex justify-content-between mt-3">
                                                                                <span class="font-weight-bold">Total</span>
                                                                                <span
                                                                                    class="font-weight-bold theme-color">৳{{ $order->total }}</span>
                                                                            </div>
                                                                            <div class="text-center mt-5">
                                                                                <form
                                                                                    action="{{ route('order.cancle', ['order' => $order->order_id]) }}"
                                                                                    method="post">
                                                                                    @csrf
                                                                                    <button type="submit"
                                                                                        class="btn btn-danger">Cancel</button>
                                                                                </form>
                                                                                <button class="btn btn-primary">Track your
                                                                                    order</button>
                                                                                <a
                                                                                    href="{{ route('order.invoice', ['order' => $order->order_id]) }}">
                                                                                    <button
                                                                                        class="btn btn-primary">Invoice</button></a>
                                                                            </div>

                                                                        </div>
                                                                        <div class="container">
                                                                            <div class="row">
                                                                                <div class="col-12  hh-grayBox pt45 pb20">
                                                                                    <div
                                                                                        class="row justify-content-between">
                                                                                        <div
                                                                                            class="order-tracking completed">
                                                                                            <span
                                                                                                class="is-complete"></span>
                                                                                            <p>Ordered<br><span>{{ $order->created_at->format('d/m/Y') }}</span>
                                                                                            </p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="order-tracking @if ($order->status == 'accepted' or $order->status == 'complete') completed @endif">
                                                                                            <span
                                                                                                class="is-complete"></span>
                                                                                            <p>Accepted @if ($order->status == 'accepted')
                                                                                                    <br><span>{{ $order->updated_at->format('d/m/Y') }}</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </div>
                                                                                        <div
                                                                                            class="order-tracking @if ($order->status == 'complete') completed @endif"">
                                                                                            <span
                                                                                                class="is-complete"></span>
                                                                                            <p>Delivered @if ($order->status == 'complete')
                                                                                                    <br><span>{{ $order->updated_at->format('d/m/Y') }}</span>
                                                                                                @endif
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- <tr id="" class="card my-3" style="display: none;">
                                                            <td colspan="100%">
                                                                <table class="w-100">
                                                                    <tr class="align-self-center">
                                                                        <th>Product Name</th>
                                                                        <th>Qty</th>
                                                                        <th>Unit Price</th>
                                                                        <th>Total</th>
                                                                        <th>Transection</th>
                                                                    </tr>
                                                                    @foreach ($order->variations as $variation)
                                                                        <tr>
                                                                            <td>{{ $variation['name_' . app()->getLocale()] }}
                                                                            </td>
                                                                            <td>
                                                                                x {{ $variation->pivot->qty }}
                                                                            </td>
                                                                            <td>
                                                                                {{ $variation->price }}
                                                                            </td>
                                                                            <td>{{ $variation->price * $variation->pivot->qty }}
                                                                            </td>
                                                                            <td>{{ $order->created_at->format('d/m/Y') }}
                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                            </td>
                                                        </tr> --}}
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!--end table-responsive-->
                                        {{-- <div class="pt-3 border-top text-right"><a href="#"
                                                class="text-primary">View all <i class="mdi mdi-arrow-right"></i></a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                        <h3 class="mb-4">Notification Settings</h3>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="notification1">
                                <label class="form-check-label" for="notification1">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum accusantium accusamus,
                                    neque cupiditate quis
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="notification2">
                                <label class="form-check-label" for="notification2">
                                    hic nesciunt repellat perferendis voluptatum totam porro eligendi.
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="notification3">
                                <label class="form-check-label" for="notification3">
                                    commodi fugiat molestiae tempora corporis. Sed dignissimos suscipit
                                </label>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary">Update</button>
                            <button class="btn btn-light">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('css')
    <style>
        a:hover {
            color: #000 !important;
        }
    </style>
@endpush

@push('js')
    <script>
        function showProducts(id) {
            $(`#vars_${id}`).toggle('active');
        }
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
                $('#total_cost').text(subTotal + parseFloat(selectedUpazila.cost) - parseFloat($(
                    '#discount').text()))
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
