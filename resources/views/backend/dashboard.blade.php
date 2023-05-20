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
        <h2 class="h4 pd-20">Best Selling Products</h2>
        <table class="data-table table nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">Product</th>
                    <th>Name</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Price</th>
                    <th>Oty</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="table-plus">
                        <img src="/static/b/vendors/images/product-1.jpg" width="70" height="70" alt="" />
                    </td>
                    <td>
                        <h5 class="font-16">Shirt</h5>
                        by John Doe
                    </td>
                    <td>Black</td>
                    <td>M</td>
                    <td>$1000</td>
                    <td>1</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <img src="/static/b/vendors/images/product-2.jpg" width="70" height="70" alt="" />
                    </td>
                    <td>
                        <h5 class="font-16">Boots</h5>
                        by Lea R. Frith
                    </td>
                    <td>brown</td>
                    <td>9UK</td>
                    <td>$900</td>
                    <td>1</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <img src="/static/b/vendors/images/product-3.jpg" width="70" height="70"
                            alt="" />
                    </td>
                    <td>
                        <h5 class="font-16">Hat</h5>
                        by Erik L. Richards
                    </td>
                    <td>Orange</td>
                    <td>M</td>
                    <td>$100</td>
                    <td>4</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <img src="/static/b/vendors/images/product-4.jpg" width="70" height="70"
                            alt="" />
                    </td>
                    <td>
                        <h5 class="font-16">Long Dress</h5>
                        by Renee I. Hansen
                    </td>
                    <td>Gray</td>
                    <td>L</td>
                    <td>$1000</td>
                    <td>1</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="table-plus">
                        <img src="/static/b/vendors/images/product-5.jpg" width="70" height="70"
                            alt="" />
                    </td>
                    <td>
                        <h5 class="font-16">Blazer</h5>
                        by Vicki M. Coleman
                    </td>
                    <td>Blue</td>
                    <td>M</td>
                    <td>$1000</td>
                    <td>1</td>
                    <td>
                        <div class="dropdown">
                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#"
                                role="button" data-toggle="dropdown">
                                <i class="dw dw-more"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                    Delete</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
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
                        return val + " Pack";
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
                            return val + " Pack";
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
