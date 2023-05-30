@extends('layouts.backend.base')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
@endpush
@section('main')
    <div class="card-box mb-30">
        <div class="pb-20 pt-20 pl-20">

            <h4 class="text-blue h4">All Users</h4>
        </div>
    </div>
    <div class="card-box  mb-30">
        <div class="pb-20 pt-20">
            <table class="table hover data-table nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">ID</th>
                        <th class="">Name</th>
                        <th class="">Email</th>
                        <th class="">Phone</th>
                        <th class="">Points</th>
                        <th>Start Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="table-plus">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->profile->point }}</td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-inline-flex">
                                    <a class="dropdown-item" href="#" class="btn-block" data-toggle="modal"
                                        data-target="#edit-modal-{{ $user->id }}" type="button"><i
                                            class="dw dw-pencil"></i>Edit</a>
                                </div>
                                <div class="modal fade bs-example-modal-lg" id="edit-modal-{{ $user->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="edit-modal-label">
                                                    Edit {{ $user->name }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.users.update', $user) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Points</label>
                                                                    <input value="{{ $user->profile->point }}"
                                                                        class="form-control" name="point" type="text"
                                                                        placeholder="Points">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
