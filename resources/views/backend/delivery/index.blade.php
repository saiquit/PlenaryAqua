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
            <h4 class="text-blue h4">All Deliveries</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-new-tag" type="button">Add New
                Delivery</button>
            <div class="modal fade bs-example-modal-lg" id="create-new-tag" tabindex="-1" role="dialog"
                aria-labelledby="edit-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="edit-modal-label">
                                Create New Delivery
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.delivery.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label> Name (English)</label>
                                                <input value="" class="form-control" name="name_en" type="text"
                                                    placeholder=" Name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label> নাম</label>
                                                <input value="" class="form-control" name="name_bn" type="text"
                                                    placeholder="ক্যাটাগরি নাম">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label> Cost</label>
                                                <input value="" class="form-control" name="cost" type="text"
                                                    placeholder="Cost">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>District Id</label>
                                                <br>
                                                <select class="form-control custom-select2" style="width: 100%"
                                                    name="district_id">
                                                    <option value="">None</option>
                                                    @foreach (App\Models\District::all() as $district)
                                                        <option value="{{ $district->id }}">
                                                            {{ $district->name_en }}</option>
                                                    @endforeach
                                                </select>
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
                        <th class="table-plus datatable-nosort">District</th>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th class="table-plus datatable-nosort">Cost</th>
                        <th>Start Date</th>
                        <th>Updated Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($deliveries as $delivery)
                        <tr>
                            <td class="table-plus">{{ $delivery->id }}</td>
                            <td>{{ $delivery->name_en }}</td>
                            <td>{{ App\Models\District::where('id', $delivery->district_id)->first()->name_en }}</td>
                            <td>{{ $delivery->cost }}</td>
                            <td>{{ Carbon\Carbon::createFromDate($delivery->created_at)->format('d/m/Y') }}</td>
                            <td>{{ Carbon\Carbon::createFromDate($delivery->updated_at)->diffForHumans() }}</td>
                            <td>
                                <div class="d-inline-flex">
                                    <a class="dropdown-item" href="#" class="btn-block" data-toggle="modal"
                                        data-target="#edit-modal-{{ $delivery->id }}" type="button"><i
                                            class="dw dw-pencil"></i>Edit</a>
                                    <a class="dropdown-item"
                                        onclick="document.querySelector('#delete_{{ $delivery->id }}').submit()"><i
                                            class="dw dw-delete-3"></i> Delete</a>
                                </div>
                                <div class="modal fade bs-example-modal-lg" id="edit-modal-{{ $delivery->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="edit-modal-label">
                                                    Edit {{ $delivery->name_en }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form
                                                    action="{{ route('admin.delivery.update', ['delivery_id' => $delivery->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label> Name (English)</label>
                                                                    <input class="form-control" name="name_en"
                                                                        type="text" value="{{ $delivery->name_en }}"
                                                                        placeholder=" Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label> নাম</label>
                                                                    <input class="form-control" name="name_bn"
                                                                        type="text" value="{{ $delivery->name_bn }}"
                                                                        placeholder="ক্যাটাগরি নাম">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label> Cost</label>
                                                                    <input class="form-control"
                                                                        value="{{ $delivery->cost }}" name="cost"
                                                                        type="text" placeholder="Cost">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>District Id</label>
                                                                    <br>
                                                                    <select class="form-control custom-select2"
                                                                        style="width: 100%" name="district_id">
                                                                        <option value="">None</option>
                                                                        @foreach (App\Models\District::all() as $district)
                                                                            <option @selected($district->id == $delivery->district_id)
                                                                                value="{{ $district->id }}">
                                                                                {{ $district->name_en }}</option>
                                                                        @endforeach
                                                                    </select>
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

                                <form id="delete_{{ $delivery->id }}"
                                    action="{{ route('admin.delivery.destory', ['district_id' => $delivery->id]) }}"
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
@endpush
