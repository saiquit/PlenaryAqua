@extends('layouts.frontend.base')

@section('main')
    <section class="py-5 my-5">
        <div class="container-fluid px-5">
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                <div class="profile-tab-nav border-right">
                    <div class="p-4">
                        <h4 class="text-center">Point: {{ $profile->point }}</h4>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active show" id="account-tab" data-toggle="pill" href="#account" role="tab"
                            aria-controls="account" aria-selected="true">
                            <i class="fa fa-home text-center mr-1"></i>
                            Account
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
                <div class="tab-content p-4 p-md-5 w-100" id="v-pills-tabContent">
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
                                <div class="col-md-6">
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
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button class="btn btn-light">Cancel</button>
                            </div>
                        </form>
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
                        <h3 class="mb-4">order Settings</h3>
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
                                                        <th>Payment Type</th>
                                                        <th>Paid Date</th>
                                                        <th>Amount</th>
                                                        <th>Transaction</th>
                                                        <th>Shipping</th>
                                                        <th>Items</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach (Auth::user()->orders as $order)
                                                        <tr>
                                                            <td>#{{ $order->order_id }}
                                                            </td>
                                                            <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                                                            <td>{{ $order->payment_method }}</td>
                                                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                                            <td>${{ $order->total }}</td>
                                                            <td>
                                                                <span
                                                                    class="badge badge-{{ $order->payment == 'pending' ? 'warning' : 'success' }}  badge-boxed badge-soft-warning">{{ $order->payment }}</span>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="badge @switch($order->shipping_status) @case('pending') badge-info @break @case('shipping') badge-warning @break @case('shipped') badge-warning @break @default badge-success @endswitch badge-boxed badge-soft-warning">{{ $order->payment }}</span>
                                                            </td>
                                                            <td onclick="showProducts({{ $order->id }})"><i
                                                                    class="fa fa-chevron-down"></i>
                                                            </td>
                                                        </tr>
                                                        <tr id="vars_{{ $order->id }}" class="card my-3"
                                                            style="display: none;">
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
                                                                                {{ $variation->current_district[0]->pivot->price }}
                                                                            </td>
                                                                            <td>{{ $variation->current_district[0]->pivot->price * $variation->pivot->qty }}
                                                                            </td>
                                                                            <td>{{ $order->created_at->format('d/m/Y') }}
                                                                            </td>

                                                                        </tr>
                                                                    @endforeach
                                                                </table>
                                                            </td>
                                                        </tr>
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
    </script>
@endpush
