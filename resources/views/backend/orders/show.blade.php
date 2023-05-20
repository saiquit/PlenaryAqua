@extends('layouts.backend.base')

@section('main')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-10 col-sm-12">
                    <div class="title">
                        <h4>Order Detail</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                Order #{{ $order->order_id }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-2 col-sm-12">
                    <form action="{{ route('admin.orders.update', $order) }}" method="post" id="shipping_form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Change Shipping</label>
                            <select onchange="document.querySelector('#shipping_form').submit()"
                                class="custom-select2 form-control" name="shipping_status"
                                style="width: 100%; height: 38px">
                                <option @selected($order->shipping_status == 'pending') value="pending">Pending</option>
                                <option @selected($order->shipping_status == 'shipping') value="shipping">Shipping</option>
                                <option @selected($order->shipping_status == 'shipped') value="shipped">Shipped</option>
                                <option @selected($order->shipping_status == 'delivered') value="delivered">Delivered</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="pb-20">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="card card-box">
                        <div class="card-body">
                            <h5 class="card-title">Order Details (#{{ $order->order_id }})</h5>
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                Date Added
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end">{{ $order->created_at->format('m/d/Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                Payment Method
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            {{ Str::ucfirst($order->payment_method) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                Shipping Status
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end">{{ $order->shipping_status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="card card-box">
                        <div class="card-body">
                            <h5 class="card-title">Customer Details</h5>
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                Customer
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end">{{ $order->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                Phone
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end">
                                            {{ $order->user->phone }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">
                                                Shipping Status
                                            </div>
                                        </td>
                                        <td class="fw-bold text-end">{{ $order->shipping_status }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 my-3">
                    <div class="card card-box">
                        <div class="card-body">
                            <h5 class="card-title">Order {{ $order->order_id }}</h5>
                            <div class="row">
                                <div class="col-md-8">
                                    {{ $order->address }},<br>
                                    {{ collect(DB::table('delivery')->find($order->upazila))['name_en'] }},<br>
                                    {{ App\Models\District::find($order->district)->name_en }},<br>
                                    Bangladesh.<br>
                                </div>
                                <div class="col-md-4">
                                    <i style="font-size: 12rem" class="icon-copy dw dw-caravan"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 my-3">
                    <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <h5 class="card-title">Shipping Address</h5>

                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-175px">Product</th>
                                            <th class="min-w-100px text-end">SKU</th>
                                            <th class="min-w-70px text-end">Qty</th>
                                            <th class="min-w-100px text-end">Unit Price</th>
                                            <th class="min-w-100px text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="fw-semibold text-gray-600">
                                        @foreach ($order->variations as $variation)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <!--begin::Thumbnail-->
                                                        <a href="/metronic8/demo34/../demo34/apps/ecommerce/catalog/edit-product.html"
                                                            class="symbol symbol-50px">
                                                            <span class="symbol-label"
                                                                style="background-image:url(/metronic8/demo34/assets/media//stock/ecommerce/1.gif);"></span>
                                                        </a>
                                                        <!--end::Thumbnail-->

                                                        <!--begin::Title-->
                                                        <div class="ms-5">
                                                            <a href="/metronic8/demo34/../demo34/apps/ecommerce/catalog/edit-product.html"
                                                                class="fw-bold text-gray-600 text-hover-primary">{{ $variation->name_en }}</a>
                                                            {{-- <div class="fs-7 text-muted">Delivery Date: 12/04/2023</div> --}}
                                                        </div>
                                                        <!--end::Title-->
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    {{ $variation->sku }} </td>
                                                <td class="text-end">
                                                    {{ $variation->pivot->qty }}
                                                </td>
                                                <td class="text-end">
                                                    ${{ $variation->price }}
                                                </td>
                                                <td class="text-end" style="text-align: right; font-weight: bold">
                                                    ${{ $variation->price * $variation->pivot->qty }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" style="text-align: right">
                                                Subtotal
                                            </td>
                                            <td style="text-align: right; font-weight: bold">
                                                ${{ $order->sub_total }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" style="text-align: right">
                                                Shipping
                                            </td>
                                            <td style="text-align: right; font-weight: bold">
                                                ${{ $order->dl_total }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="fs-3 text-dark"
                                                style="text-align: right; font-weight: bold">
                                                Grand Total
                                            </td>
                                            <td class="text-dark fs-3 fw-bolder"
                                                style="text-align: right; font-weight: bold">
                                                ${{ $order->total }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
