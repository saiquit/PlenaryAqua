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
            <h4 class="text-blue h4">All Projects</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-new-project" type="button">Add New
                Projects</button>
            <div class="modal fade bs-example-modal-lg" id="create-new-project" tabindex="-1" role="dialog"
                aria-labelledby="edit-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="edit-modal-label">
                                Create New Project
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Project Name (English)</label>
                                                <input value="" class="form-control" name="project_name_en"
                                                    type="text" placeholder="Project Name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>প্রোজেক্ট নাম</label>
                                                <input value="" class="form-control" name="project_name_bn"
                                                    type="text" placeholder="প্রোজেক্ট নাম">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12">
                                            <div id="feature_img" class="d-flex flex-column">
                                                <label>Feature Image</label>
                                                <input name="feature_img" type="file" accept="image/*">
                                                <img class="img" id="output" src="#" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label>Project Description (English)</label>
                                            <div class="pd-20 card-box mb-30">
                                                <textarea class="tiny border-radius-0" name="project_desc_en" placeholder="Enter text ..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label>Project Description (Bangla)</label>
                                            <div class="pd-20 card-box mb-30">
                                                <textarea class="tiny border-radius-0" name="project_desc_bn" placeholder="Enter text ..."></textarea>
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
                        <th class="table-plus datatable-nosort">Name</th>
                        <th>Start Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td class="table-plus">{{ $project->id }}</td>
                            <td>{{ $project->name_en }}</td>
                            <td>{{ $project->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-inline-flex">
                                    <a class="dropdown-item" href="#" class="btn-block" data-toggle="modal"
                                        data-target="#edit-modal-{{ $project->id }}" type="button"><i
                                            class="dw dw-pencil"></i>Edit</a>
                                    <a class="dropdown-item"
                                        onclick="document.querySelector('#delete_{{ $project->id }}').submit()"><i
                                            class="dw dw-delete-3"></i> Delete</a>
                                </div>
                                <div class="modal fade bs-example-modal-lg" id="edit-modal-{{ $project->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="edit-modal-label">
                                                    Edit {{ $project->name_en }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.projects.update', $project) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>Project Name (English)</label>
                                                                    <input value="{{ $project->name_en }}"
                                                                        class="form-control" name="project_name_en"
                                                                        type="text" placeholder="Project Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>প্রোজেক্ট নাম</label>
                                                                    <input value="{{ $project->name_bn }}"
                                                                        class="form-control" name="project_name_bn"
                                                                        type="text" placeholder="প্রোজেক্ট নাম">
                                                                </div>
                                                            </div>

                                                            <div class="col-12 col-md-12">
                                                                <div id="feature_img" class="d-flex flex-column">
                                                                    <label>feature Image</label>
                                                                    <input name="feature_img" type="file"
                                                                        accept="image/*">
                                                                    <img class="img" id="output"
                                                                        src="{{ url('storage/' . $project->featured_img) }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <label>Project Description (English)</label>
                                                                <div class="pd-20 card-box mb-30">
                                                                    <textarea class="tiny border-radius-0" name="project_desc_en" placeholder="Enter text ...">{!! $project->desc_en !!}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <label>Project Description (Bangla)</label>
                                                                <div class="pd-20 card-box mb-30">
                                                                    <textarea class="tiny border-radius-0" name="project_desc_bn" placeholder="Enter text ...">{!! $project->desc_bn !!}</textarea>
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

                                <form id="delete_{{ $project->id }}"
                                    action="{{ route('admin.projects.destroy', $project) }}" method="POST" hidden>
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
    <script src="{{ asset('static/b/vendors/scripts/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '.tiny'
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#cover_img input, #feature_img input').on('change', function(event) {
                var reader = new FileReader();
                var output = $(this).siblings('img');
                reader.onload = function() {
                    $(output).attr('src', reader.result);
                };
                reader.readAsDataURL(event.target.files[0]);
            })
        });
    </script>
@endpush
