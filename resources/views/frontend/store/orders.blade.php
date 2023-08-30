@extends('layouts.frontend.base')
@section('title')
    Orders
@endsection
@push('css')
    <style>
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
    <div class="container">
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
                                        <th>Customer Name</th>
                                        <th>Order Date</th>
                                        <th>Amount</th>
                                        <th>Order Status</th>
                                        <th>Shipping</th>
                                        <th>Show Items</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
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
                                                    <button class="btn btn-danger" disabled>Canceled</button>
                                                @else
                                                    <button @disabled($order->status == 'canceled') class="btn btn-primary"
                                                        data-toggle="modal" data-target="#vars_{{ $order->id }}"><i
                                                            class="icon_bag_alt"></i></button>
                                                @endif
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="vars_{{ $order->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="vars_{{ $order->id }}_Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body ">
                                                        <div class="text-right"> <i class="fa fa-close close"
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
                                                                <div class="d-flex justify-content-between">
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
                                                                <div class="d-flex justify-content-between">
                                                                    <small>Discount</small>
                                                                    <small>৳{{ $order->discount }}</small>
                                                                </div>
                                                            @endif
                                                            <div class="d-flex justify-content-between mt-3">
                                                                <span class="font-weight-bold">Total</span>
                                                                <span
                                                                    class="font-weight-bold theme-color">৳{{ $order->total }}</span>
                                                            </div>
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-12  hh-grayBox pt45 pb20">
                                                                        <div class="row justify-content-between">
                                                                            <div class="order-tracking completed">
                                                                                <span class="is-complete"></span>
                                                                                <p>Ordered<br><span>{{ $order->created_at->format('d/m/Y') }}</span>
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="order-tracking @if ($order->status == 'accepted' or $order->status == 'complete') completed @endif">
                                                                                <span class="is-complete"></span>
                                                                                <p>Accepted @if ($order->status == 'accepted')
                                                                                        <br><span>{{ $order->updated_at->format('d/m/Y') }}</span>
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                            <div
                                                                                class="order-tracking @if ($order->status == 'complete') completed @endif"">
                                                                                <span class="is-complete"></span>
                                                                                <p>Delivered @if ($order->status == 'complete')
                                                                                        <br><span>{{ $order->updated_at->format('d/m/Y') }}</span>
                                                                                    @endif
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-center mt-5">
                                                                <form
                                                                    action="{{ route('order.cancle', ['order' => $order->order_id]) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Cancel</button>
                                                                </form>
                                                                <a
                                                                    href="{{ route('order.invoice', ['order' => $order->order_id]) }}">
                                                                    <button class="btn btn-primary">Invoice</button></a>
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
@endsection
