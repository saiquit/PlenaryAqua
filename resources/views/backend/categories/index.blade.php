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
            <h4 class="text-blue h4">All Categories</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-new-category" type="button">Add New
                Categories</button>
            <div class="modal fade bs-example-modal-lg" id="create-new-category" tabindex="-1" role="dialog"
                aria-labelledby="edit-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="edit-modal-label">
                                Create New Category
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.categories.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Category Name (English)</label>
                                                <input value="" class="form-control" name="category_name_en"
                                                    type="text" placeholder="Category Name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>ক্যাটাগরি নাম</label>
                                                <input value="" class="form-control" name="category_name_bn"
                                                    type="text" placeholder="ক্যাটাগরি নাম">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <label>Parent Category</label>
                                                <br>
                                                <select class="form-control custom-select2" style="width: 100%"
                                                    name="parent">
                                                    <option value="">None</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div id="cover_img" class="d-flex flex-column">
                                                <label>Cover Image</label>
                                                <input name="cover_img" type="file" accept="image/*">
                                                <img class="img" id="output" src="#" />
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div id="feature_img" class="d-flex flex-column">
                                                <label>feature Image</label>
                                                <input name="feature_img" type="file" accept="image/*">
                                                <img class="img" id="output" src="#" />
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
            <table class="table hover data-table-category nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Sort ID</th>
                        <th class="table-plus datatable-nosort">Name</th>
                        <th class="table-plus datatable-nosort">Products</th>
                        <th>Start Date</th>
                        <th>Updated Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->sort }}</td>
                            <td>{{ $category->name_en }}</td>
                            <td>{{ $category->products->count() }}</td>
                            <td>{{ $category->created_at->format('d/m/Y') }}</td>
                            <td>{{ $category->updated_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-inline-flex">
                                    <a class="dropdown-item" href="#" class="btn-block" data-toggle="modal"
                                        data-target="#edit-modal-{{ $category->id }}" type="button"><i
                                            class="dw dw-pencil"></i>Edit</a>
                                    <a class="dropdown-item"
                                        onclick="document.querySelector('#delete_{{ $category->id }}').submit()"><i
                                            class="dw dw-delete-3"></i> Delete</a>
                                </div>
                                <div class="modal fade bs-example-modal-lg" id="edit-modal-{{ $category->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="edit-modal-label">
                                                    Edit {{ $category->name_en }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.categories.update', $category) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Sorting Rank</label>
                                                                    <input value="{{ $category->sort }}"
                                                                        class="form-control" name="sort"
                                                                        type="text" placeholder="Sort Number">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Category Name (English)</label>
                                                                    <input value="{{ $category->name_en }}"
                                                                        class="form-control" name="category_name_en"
                                                                        type="text" placeholder="Category Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="form-group">
                                                                    <label>ক্যাটাগরি নাম</label>
                                                                    <input value="{{ $category->name_bn }}"
                                                                        class="form-control" name="category_name_bn"
                                                                        type="text" placeholder="ক্যাটাগরি নাম">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Parent Category</label>
                                                                    <br>
                                                                    <select class="form-control custom-select2"
                                                                        style="width: 100%" name="parent">
                                                                        <option value="">None</option>
                                                                        @foreach ($categories as $diff_cat)
                                                                            @if ($diff_cat->id != $category->id)
                                                                                <option
                                                                                    @if ($category->parent and $category->parent->id == $diff_cat->id) selected="selected" @endif
                                                                                    value="{{ $diff_cat->id }}">
                                                                                    {{ $diff_cat->name_en }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div id="cover_img" class="d-flex flex-column">
                                                                    <label>Cover Image</label>
                                                                    <input name="cover_img" type="file"
                                                                        accept="image/*">
                                                                    <img class="img" id="output"
                                                                        src="{{ url('storage/' . $category->cover_img) }}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div id="feature_img" class="d-flex flex-column">
                                                                    <label>feature Image</label>
                                                                    <input name="feature_img" type="file"
                                                                        accept="image/*">
                                                                    <img class="img" id="output"
                                                                        src="{{ url('storage/' . $category->featured_img) }}" />
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

                                <form id="delete_{{ $category->id }}"
                                    action="{{ route('admin.categories.destroy', $category) }}" method="POST" hidden>
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

            $('.data-table-category').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                columnDefs: [{
                    targets: "datatable-nosort",
                    orderable: false,
                }],
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "pageLength": 50,
                "language": {
                    "info": "_START_-_END_ of _TOTAL_ entries",
                    searchPlaceholder: "Search",
                    paginate: {
                        next: '<i class="ion-chevron-right"></i>',
                        previous: '<i class="ion-chevron-left"></i>'
                    }
                },
                "order": [
                    [0, "asc"]
                ]
            });

        });
    </script>
@endpush
