@extends('layouts.backend.base')
@section('main')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-20">
            <div class="pull-left">
                <h4 class="text-blue h4">List of Offers</h4>
                {{-- <p>Add class <code>.table</code></p> --}}
            </div>
            <div class="pull-right">
                <button class="btn btn-primary btn-sm scroll-click"class="btn btn-primary" data-toggle="modal"
                    data-target="#create-new-slide" type="button">Create New</button>
            </div>
            <div class="modal fade bs-example-modal-lg" id="create-new-slide" tabindex="-1" role="dialog"
                aria-labelledby="edit-modal-label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="edit-modal-label">
                                Create New Offers
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.ui.store_offers') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Heading (English)</label>
                                                <input value="" class="form-control" name="heading_en" type="text"
                                                    placeholder="Heading (English)">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>হেডিং</label>
                                                <input value="" class="form-control" name="heading_bn" type="text"
                                                    placeholder="হেডিং">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>Sub Heading (English)</label>
                                                <input value="" class="form-control" name="sub_heading_en"
                                                    type="text" placeholder="Sub Heading (English)">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label>সাব হেডিং</label>
                                                <input value="" class="form-control" name="sub_heading_bn"
                                                    type="text" placeholder="সাব হেডিং">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-12">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <br>
                                                <select class="form-control custom-select2" style="width: 100%"
                                                    name="parent">
                                                    <option value="">None</option>
                                                    @foreach (App\Models\Category::all() as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->name_en }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <div id="banner_img" class="d-flex flex-column">
                                                <label>Banner</label>
                                                <input name="banner_img" type="file" accept="image/*">
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
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Image</th>
                    <th scope="col">Heading</th>
                    <th scope="col">Sub Heading</th>
                    <th scope="col">Status</th>
                    <th scope="col">Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($offers as $offer)
                    <tr>
                        <th scope="row">{{ $offer->id }}</th>
                        <td><img src="{{ url('storage/' . $offer->image, []) }}" width="200" alt=""></td>
                        <td>{{ $offer->heading_en }}</td>
                        <td>{{ $offer->sub_heading_en }}</td>
                        <td>
                            @if ($offer->active)
                                <span class="badge badge-primary">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>{{ Carbon\Carbon::create($offer->created_at)->format('d-M-y') }}</td>
                        <td>
                            <div class="table-actions">
                                <a class="dropdown-item" href="#" class="btn-block" data-toggle="modal"
                                    data-target="#edit-modal-{{ $offer->id }}" type="button" data-color="#265ed7"
                                    style="color: rgb(38, 94, 215);"><i class="icon-copy dw dw-edit2"></i></a>
                                <a href="#" class="dropdown-item"
                                    onclick="document.querySelector('#delete_{{ $offer->id }}').submit()"
                                    data-color="#e95959" style="color: rgb(233, 89, 89);"><i
                                        class="icon-copy dw dw-delete-3"></i></a>
                            </div>
                            <div class="modal fade bs-example-modal-lg" id="edit-modal-{{ $offer->id }}"
                                tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="edit-modal-label">
                                                Edit {{ $offer->heading_en }}
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-hidden="true">
                                                ×
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.ui.offers_update', $offer->id) }}"
                                                method="post" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="form">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="custom-control custom-checkbox mb-5">
                                                                    <input @checked($offer->active) type="checkbox"
                                                                        class="custom-control-input"
                                                                        id="active_box_{{ $offer->id }}"
                                                                        name="active">
                                                                    <label class="custom-control-label"
                                                                        for="active_box_{{ $offer->id }}">Check this to
                                                                        active this offer
                                                                        in homepage</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label>Heading (English)</label>
                                                                <input value="{{ $offer->heading_en }}"
                                                                    class="form-control" name="heading_en" type="text"
                                                                    placeholder="Heading (English)">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label>হেডিং</label>
                                                                <input value="{{ $offer->heading_bn }}"
                                                                    class="form-control" name="heading_bn" type="text"
                                                                    placeholder="হেডিং">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label>Sub Heading (English)</label>
                                                                <input value="{{ $offer->sub_heading_en }}"
                                                                    class="form-control" name="sub_heading_en"
                                                                    type="text" placeholder="Sub Heading (English)">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="form-group">
                                                                <label>সাব হেডিং</label>
                                                                <input value="{{ $offer->sub_heading_bn }}"
                                                                    class="form-control" name="sub_heading_bn"
                                                                    type="text" placeholder="সাব হেডিং">
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-md-12">
                                                            <div class="form-group">
                                                                <label>Category</label>
                                                                <br>
                                                                <select class="form-control custom-select2"
                                                                    style="width: 100%" name="parent">
                                                                    <option value="">None</option>
                                                                    @foreach (App\Models\Category::all() as $category)
                                                                        <option @selected($category->id == $offer->category_id)
                                                                            value="{{ $category->id }}">
                                                                            {{ $category->name_en }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-12">
                                                            <div id="banner_img" class="d-flex flex-column">
                                                                <label>Banner</label>
                                                                <input name="banner_img" type="file" accept="image/*">
                                                                <img class="img" id="output"
                                                                    src="{{ url('storage/' . $offer->image, []) }}" />
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

                            <form id="delete_{{ $offer->id }}"
                                action="{{ route('admin.ui.offers_delete', $offer->id) }}" method="POST" hidden>
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#banner_img input').on('change', function(event) {
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
