@extends('layouts.backend.base')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/src/styles/image-uploader.min.css') }}" />
@endpush
@section('main')
    <form class="dropzone" enctype="multipart/form-data" action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Create Product</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Create Product
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix"></div>
                <div class="form">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Product Name (English)</label>
                                <input class="form-control" name="product_name_en" type="text"
                                    placeholder="Product Name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>প্রোডাক্টের নাম</label>
                                <input class="form-control" name="product_name_bn" type="text"
                                    placeholder="প্রোডাক্টের নাম">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Product Decription (English)</label>
                                <textarea class="tiny border-radius-0" name="product_desc_en" placeholder="Enter text ..."></textarea>

                                {{-- <textarea class="form-control" name="product_desc_en"></textarea> --}}
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>প্রোডাক্টের বর্ণনা</label>
                                <textarea class="tiny border-radius-0" name="product_desc_bn" placeholder="Enter text ..."></textarea>

                                {{-- <textarea class="form-control" name="product_desc_bn"></textarea> --}}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Select Categories</label>
                                <select class="custom-select2 form-control" multiple style="width: 100%"
                                    name="categories[]">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <div class="input-images" style="padding-top: .5rem;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pd-20 card-box mb-30">
                <div class="row d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary ">Add Product</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('js')
    <script src="{{ asset('static/b/src/scripts/image-uploader.min.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '.tiny'
        });
    </script>
    <script>
        $(function() {

            $('.input-images').imageUploader({
                imagesInputName: 'images',
            });
        });
    </script>
@endpush
