@extends('layouts.backend.base')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/src/plugins/switchery/switchery.min.css') }}" />
@endpush
@section('main')
    <!-- Export Datatable start -->
    <div class="card-box mb-30">
        <div class="pd-20">
            <h4 class="text-blue h4">All Coupons</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-new-tag" type="button">Add New
                Coupon</button>
            <div class="modal fade bs-example-modal-lg" id="create-new-tag" tabindex="-1" role="dialog"
                aria-labelledby="edit-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="edit-modal-label">
                                Create New Coupon
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.coupons.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Active</label><br>
                                                <input type="checkbox" name="active" checked class="switch-btn"
                                                    data-color="#0099ff" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Key</label><br>
                                                <input value="" class="form-control" name="key" type="text"
                                                    placeholder="Key">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Amount</label>
                                                <input value="" class="form-control" name="amount" type="text"
                                                    placeholder="Amount in TAKA">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Available</label>
                                                <input value="" class="form-control" name="avaliable" type="text"
                                                    placeholder="Avaliable Coupons">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Validity</label>
                                                <input name="validity" class="form-control date-picker"
                                                    placeholder="Select Date" type="text" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        Save changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-20">
            <table class="table hover data-table nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">ID</th>
                        <th class="">KEY</th>
                        <th class="">AMOUNT</th>
                        <th class="">AVAILABLE COUPONS</th>
                        <th class="">VALIDITY</th>
                        <th>Start Date</th>
                        <th>Updated Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupons as $coupon)
                        <tr>
                            <td class="table-plus">{{ $coupon->id }}</td>
                            <td>{{ $coupon->key }}</td>
                            <td>{{ $coupon->amount }}</td>
                            <td>{{ $coupon->avaliable }}</td>
                            <td>{{ Carbon\Carbon::createFromDate($coupon->validity)->format('d F Y') }}</td>
                            <td>{{ Carbon\Carbon::createFromDate($coupon->created_at)->format('d/m/Y') }}</td>
                            <td>{{ Carbon\Carbon::createFromDate($coupon->updated_at)->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-inline-flex">
                                    <a class="dropdown-item" href="#" class="btn-block" data-toggle="modal"
                                        data-target="#edit-modal-{{ $coupon->id }}" type="button"><i
                                            class="dw dw-pencil"></i>Edit</a>
                                    <a class="dropdown-item"
                                        onclick="document.querySelector('#delete_{{ $coupon->id }}').submit()"><i
                                            class="dw dw-delete-3"></i> Delete</a>
                                </div>
                                <div class="modal fade bs-example-modal-lg" id="edit-modal-{{ $coupon->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="edit-modal-label">
                                                    Edit {{ $coupon->key }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('admin.coupons.update', ['coupon_id' => $coupon->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Active</label><br>
                                                                    <input type="checkbox" name="active"
                                                                        @checked($coupon->active) class="switch-btn"
                                                                        data-color="#0099ff" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Key</label><br>
                                                                    <input value="{{ $coupon->key }}"
                                                                        class="form-control" name="key"
                                                                        type="text" placeholder="Key">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Amount</label>
                                                                    <input value="{{ $coupon->amount }}"
                                                                        class="form-control" name="amount"
                                                                        type="text" placeholder="Amount in TAKA">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Available</label>
                                                                    <input value="{{ $coupon->avaliable }}"
                                                                        class="form-control" name="avaliable"
                                                                        type="text" placeholder="Avaliable Coupons">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Validity</label>
                                                                    <input name="validity"
                                                                        value="{{ Carbon\Carbon::createFromDate($coupon->validity)->format('d F Y') }}"
                                                                        class="form-control date-picker"
                                                                        placeholder="Select Date" type="text" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                            Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            Save changes
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form id="delete_{{ $coupon->id }}"
                                    action="{{ route('admin.coupons.destory', ['coupon_id' => $coupon->id]) }}"
                                    method="POST" hidden>
                                    @csrf
                                    @method('DELETE')
                                </form>
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
    <script src="{{ asset('static/b/src/plugins/switchery/switchery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
            $('.switch-btn').each(function() {
                new Switchery($(this)[0], $(this).data());
            });
        });
    </script>
@endpush
