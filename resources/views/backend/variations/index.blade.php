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
            <h4 class="text-blue h4">All Products</h4>
        </div>
        <div class="pb-20">
            <table class="table hover data-table nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">ID</th>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th>Number of Variation</th>
                        <th>Start Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="table-plus">{{ $product->id }}</td>
                            <td>{{ $product->name_en }}</td>
                            <td>{{ $product->variations->count() }}</td>
                            <td>{{ $product->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('admin.products.show', $product->id) }}"><i
                                                class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
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
