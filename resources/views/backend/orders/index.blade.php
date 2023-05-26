@extends('layouts.backend.base')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
@endpush
@section('main')
    <!-- Export Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">All Orders</h4>
        </div>
        <div class="pb-20">
            <table class="table hover data-table-export nowrap">
                <thead>
                    <tr>
                        <th class="table-plus">ID</th>
                        <th class="table-plus datatable-nosort">Shiping</th>
                        <th class="table-plus datatable-nosort">Phone</th>
                        <th>Total</th>
                        <th>Quantity</th>
                        <th>Weight</th>
                        <th>Payment Status</th>
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
                            <td>৳{{ $order->total }}</td>
                            <td>{{ $order->qty_total }}</td>
                            <td>{{ $order->wt_total }} KG</td>
                            <td><span
                                    class="badge badge-pill @switch($order->payment) @case('pending') badge-info @break  @default badge-success @endswitch">{{ Str::ucfirst($order->payment) }}</span>
                            </td>
                            <td>{{ App\Models\District::find($order->district)->name_en }},
                                {{ collect(DB::table('delivery')->find($order->upazila))['name_en'] }}</td>
                            <td>{{ $order->address }}</td>
                            <td>{{ $order->created_at->format('d/m/Y') }}</td>
                            <td>
                                @foreach ($order->variations as $key => $variation)
                                    <p>{{ $key + 1 }} . {{ $variation->product->name_en }} x <span
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
    <!-- Export Datatable End -->
@endsection

@push('js')
    <script src="{{ asset('static/b/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('static/b/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('static/b/vendors/scripts/datatable-setting.js') }}"></script>
@endpush
