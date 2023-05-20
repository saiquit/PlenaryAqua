@extends('layouts.backend.base')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
@endpush
@section('main')
    <div class="card-box pd-20 height-100-p mb-30">
        <div class="row align-items-center">
            <div class="col-md-4">
                <img src="{{ asset('/static/b/vendors/images/banner-img.png') }}" alt="" />
            </div>
            <div class="col-md-8">
                <h4 class="font-20 weight-500 mb-10 text-capitalize">
                    Welcome back
                    <div class="weight-600 font-30 text-blue">Admin</div>
                </h4>
                <p class="font-18 max-width-600">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde
                    hic non repellendus debitis iure, doloremque assumenda. Autem
                    modi, corrupti, nobis ea iure fugiat, veniam non quaerat
                    mollitia animi error corporis.
                </p>
            </div>
        </div>
    </div>
    <div class="row pb-10">
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{ App\Models\Product::count() }}</div>
                        <div class="font-14 text-secondary weight-500">
                            Products
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                            <i class="icon-copy dw dw-folder"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">BDT
                            {{ DB::table('orders')->whereMonth('created_at', Carbon\Carbon::now()->month)->where('shipping_status', 'delivered')->get()->sum('total') }}
                        </div>
                        <div class="font-14 text-secondary weight-500">
                            Total Sell This Month
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                            <i class="icon-copy dw dw-library"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">
                            {{ App\Models\Order::where('shipping_status', 'delivered')->count() }}</div>
                        <div class="font-14 text-secondary weight-500">
                            Total Completed Orders
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" style="color: rgb(12, 215, 52);">
                            <i class="icon-copy dw dw-checked"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">
                            {{ App\Models\Order::where('shipping_status', 'pending')->count() }}</div>
                        <div class="font-14 text-secondary weight-500">Pending Orders</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" style="color: rgb(204, 6, 6);">
                            <i class="icon-copy dw dw-bell1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">Total Sells on last 12 months</h2>
                <div id="chart5"></div>
            </div>
        </div>
        <div class="col-xl-4 mb-30">
            <div class="card-box height-100-p pd-20">
                <h2 class="h4 mb-20">Lead Target</h2>
                <div id="chart6"></div>
            </div>
        </div>
    </div>
    <div class="card-box mb-30">
        <h2 class="h4 pd-20">Pending Orders</h2>
        <div class="pb-20">
            <table class="table hover data-table-export nowrap">
                <thead>
                    <tr>
                        <th class="table-plus">ID</th>
                        <th class="table-plus datatable-nosort">Shiping</th>
                        <th class="table-plus datatable-nosort">Phone</th>
                        <th class="table-plus datatable-nosort">User</th>
                        <th>Total</th>
                        <th>Quantity</th>
                        <th>Weight</th>
                        <th>Payment Status</th>
                        <th>Method</th>
                        <th>District, Upazila</th>
                        <th>Area</th>
                        <th>Order Date</th>
                        <th>Products</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="table-plus">#{{ $order->order_id }}</td>
                            <td class="table-plus">
                                <form action="{{ route('admin.orders.update', $order) }}" method="post"
                                    id="shipping_form_{{ $order->id }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <select
                                            onchange="document.querySelector('#shipping_form_{{ $order->id }}').submit()"
                                            class="custom-select2 form-control" name="shipping_status"
                                            style="width: 100%; height: 38px">
                                            <option @selected($order->shipping_status == 'pending') value="pending">Pending</option>
                                            <option @selected($order->shipping_status == 'shipping') value="shipping">Shipping</option>
                                            <option @selected($order->shipping_status == 'shipped') value="shipped">Shipped</option>
                                            <option @selected($order->shipping_status == 'delivered') value="delivered">Delivered</option>
                                        </select>
                                    </div>
                                </form>
                            </td>
                            <td>{{ $order->phone }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td>৳{{ $order->total }}</td>
                            <td>{{ $order->qty_total }}</td>
                            <td>{{ $order->wt_total }} KG</td>
                            <td><span
                                    class="badge badge-pill @switch($order->payment) @case('pending') badge-info @break  @default badge-success @endswitch">{{ Str::ucfirst($order->payment) }}</span>
                            </td>
                            <td>{{ $order->payment_method }}</td>
                            <td>{{ App\Models\District::find($order->district)->name_en }},
                                {{ collect(DB::table('delivery')->find($order->upazila))['name_en'] }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>
                                @foreach ($order->variations as $key => $variation)
                                    <p>{{ $key + 1 }}.{{ $variation->name_en }} x <span
                                            class="badge badge-pill badge-primary">{{ $variation->pivot->qty }}</span></p>
                                @endforeach
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('admin.orders.show', $order->id) }}"><i
                                                class="dw dw-eye"></i> View</a>
                                        {{-- <a class="dropdown-item" href="{{ route('admin.products.edit', $product) }}"><i
                                                class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item"
                                            onclick="document.querySelector('#delete_{{ $product->id }}').submit()"><i
                                                class="dw dw-delete-3"></i> Delete</a>
                                        <form id="delete_{{ $product->id }}"
                                            action="{{ route('admin.products.destroy', $product) }}" method="POST" hidden>
                                            @csrf
                                            @method('DELETE')
                                        </form> --}}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('static/b/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/dashboard.js') }}"></script>

    <script>
        $(document).ready(function() {
            //Col Chart Data
            var c_data = @json($data);
            var x_axis = [];
            var total = []
            for (const key in c_data) {
                if (Object.hasOwnProperty.call(c_data, key)) {
                    const element = c_data[key];
                    x_axis.push(element.name)
                    total['name'] = 'Total';
                    if (!total['data']) {
                        total['data'] = [];
                    }
                    total['data'] = [...total['data'], element.total]
                }
            }
            var options = {
                series: [total],
                chart: {
                    height: 350,
                    type: 'bar',
                },
                colors: ["#DC6900", "#EB8C00", "#E0301E", "#A32020", "#602320"],
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        distributed: true
                    }
                },
                dataLabels: {
                    enabled: true,
                    formatter: function(val) {
                        return val + " BDT";
                    },
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#602320"],
                    }
                },
                xaxis: {
                    categories: x_axis,
                    position: 'bottom',
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    tooltip: {
                        enabled: true,
                    }
                },
                yaxis: {
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false,
                    },
                    labels: {
                        show: false,
                        formatter: function(val) {
                            return val + " BDT";
                        }
                    }
                },
            };
            var chart = new ApexCharts(document.querySelector("#chart5"), options);
            chart.render();

            //Pi chart Data
            var pi_data = @json($pi_data);
            var pi_x_axis = [];
            var pi_y_axis = [];
            for (const key in pi_data) {
                if (Object.hasOwnProperty.call(pi_data, key)) {
                    const element = pi_data[key];
                    pi_x_axis.push(key);
                    pi_y_axis.push(element);
                }
            }
            var options = {
                series: pi_y_axis,
                chart: {
                    // width: 380,
                    type: 'pie',
                },
                labels: pi_x_axis,

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart2 = new ApexCharts(document.querySelector("#chart6"), options);
            chart2.render();
        });
    </script>
@endpush
