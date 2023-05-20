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
            <h4 class="text-blue h4">All Blogs</h4>
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-new-blog" type="button">Add New
                Blog</button>
            <div class="modal fade bs-example-modal-lg" id="create-new-blog" tabindex="-1" role="dialog"
                aria-labelledby="edit-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="edit-modal-label">
                                Create New Blog
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form">
                                    <div class="row">
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <label>Blog title </label>
                                                <input value="" class="form-control" name="title" type="text"
                                                    placeholder="Blog Name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <label>Author Name </label>
                                                <input value="" class="form-control" name="author" type="text"
                                                    placeholder="Blog Name">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <label>Short description </label>
                                                <input value="" class="form-control" name="short_desc" type="text"
                                                    placeholder="Short Description">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label>Blog Content </label>

                                            <div class="html-editor pd-20 card-box mb-30">
                                                {{-- <h4 class="h4 text-blue">bootstrap wysihtml5</h4> --}}
                                                {{-- <p>Simple, beautiful wysiwyg editors</p> --}}
                                                <textarea class="textarea_editor form-control border-radius-0" name="content" placeholder="Enter text ..."></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <br>
                                                <select multiple class="form-control custom-select2" style="width: 100%"
                                                    name="categories[]">
                                                    <option value="">None</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div id="cover_img" class="d-flex flex-column">
                                                <label>Cover Image</label>
                                                <input name="cover_img" type="file" accept="image/*">
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
            <table class="table hover data-table-blog nowrap">
                <thead>
                    <tr>
                        <th class="table-plus">ID</th>
                        <th class="table-plus datatable-nosort">Cover</th>
                        <th class="table-plus">Name</th>
                        <th class="table-plus datatable-nosort">Description</th>
                        <th class="table-plus">Views</th>
                        <th>Start Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr>
                            <td class="table-plus">{{ $blog->id }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{!! Str::substr($blog->short_desc, 0, 50) . '...' !!}</td>
                            <td>{{ $blog->views }}</td>
                            <td>{{ $blog->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-inline-flex">
                                    <a class="dropdown-item" href="#" class="btn-block" data-toggle="modal"
                                        data-target="#edit-modal-{{ $blog->id }}" type="button"><i
                                            class="dw dw-pencil"></i>Edit</a>
                                    <a class="dropdown-item"
                                        onclick="document.querySelector('#delete_{{ $blog->id }}').submit()"><i
                                            class="dw dw-delete-3"></i> Delete</a>
                                </div>
                                <div class="modal fade bs-example-modal-lg" id="edit-modal-{{ $blog->id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="edit-modal-label">
                                                    Edit {{ $blog->name_en }}
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-hidden="true">
                                                    ×
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.blogs.update', $blog) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @method('PUT')
                                                    @csrf
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Blog title </label>
                                                                    <input value="{{ $blog->title }}" value=""
                                                                        class="form-control" name="title"
                                                                        type="text" placeholder="Blog Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Author Name </label>
                                                                    <input value="{{ $blog->author_name }}"
                                                                        class="form-control" name="author"
                                                                        type="text" placeholder="Author Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Short description </label>
                                                                    <input value="{{ $blog->short_desc }}"
                                                                        class="form-control" name="short_desc"
                                                                        type="text" placeholder="Short Description">
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <label>Blog Content </label>
                                                                <div class="html-editor pd-20 card-box mb-30">
                                                                    <textarea class="textarea_editor form-control border-radius-0" name="content" placeholder="Enter text ...">{!! $blog->content !!}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <div class="form-group">
                                                                    <label>Category</label>
                                                                    <br>
                                                                    <select class="form-control custom-select2"
                                                                        style="width: 100%" multiple name="categories[]">
                                                                        <option value="">None</option>
                                                                        @foreach ($categories as $category)
                                                                            <option @selected($blog->categories->contains($category->id))
                                                                                value="{{ $category->id }}">
                                                                                {{ $category->name_en }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-12">
                                                                <div id="cover_img" class="d-flex flex-column">
                                                                    <label>Cover Image</label>
                                                                    <input name="cover_img" type="file"
                                                                        accept="image/*">
                                                                    <img class="img" id="output"
                                                                        src="{{ url('storage/' . $blog->cover_img) }}" />
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

                                <form id="delete_{{ $blog->id }}" action="{{ route('admin.blogs.destroy', $blog) }}"
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
            $('.data-table-blog').DataTable({
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
                    [0, "desc"]
                ]
            });
        });
    </script>
@endpush
