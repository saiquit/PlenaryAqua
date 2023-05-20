@extends('layouts.backend.base')
@push('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
@endpush
@section('main')
    <!-- Export Datatable start -->
    <div class=" mb-30">
        <div class="card-box mb-20 pd-20">
            <h4 class="text-blue h4">All Pages</h4>
        </div>
        <div class="p-20">
            <form class="dropzone" enctype="multipart/form-data" action="{{ route('admin.page.store') }}" method="POST">
                @csrf
                <div class="min-height-200px">
                    <div class="pd-20  mb-30">
                        <div class="clearfix"></div>
                        <div class="form">
                            <fieldset class="">
                                <h4 class="text-blue h4">Terms and Condition</h4>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label>Terms and Condition (English)</label>
                                        <div class="pd-20 card-box mb-30">
                                            <textarea class="tiny border-radius-0" name="terms[en]" placeholder="Enter text ...">{!! $data->where('name', 'terms') ? $data->where('name', 'terms')->first()->en : null !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>Terms and Condition (Bangla)</label>
                                        <div class="pd-20 card-box mb-30">
                                            <textarea class="tiny border-radius-0" name="terms[bn]" placeholder="Enter text ...">{!! $data->where('name', 'terms') ? $data->where('name', 'terms')->first()->bn : null !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4 class="text-blue h4">About us</h4>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label>About Us (English)</label>
                                        <div class="pd-20 card-box mb-30">
                                            <textarea class="tiny border-radius-0" name="about[en]" placeholder="Enter text ...">{!! $data->where('name', 'about') ? $data->where('name', 'about')->first()->en : null !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>About Us (Bangla)</label>
                                        <div class="pd-20 card-box mb-30">
                                            <textarea class="tiny border-radius-0" name="about[bn]" placeholder="Enter text ...">{!! $data->where('name', 'about') ? $data->where('name', 'about')->first()->bn : null !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <h4 class="text-blue h4">Return Policy</h4>
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <label>Return Policy (English)</label>
                                        <div class="pd-20 card-box mb-30">
                                            <textarea class="tiny border-radius-0" name="r_policy[en]" placeholder="Enter text ...">{!! $data->where('name', 'r_policy') ? $data->where('name', 'r_policy')->first()->en : null !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <label>Return Policy (Bangla)</label>
                                        <div class="pd-20 card-box mb-30">
                                            <textarea class="tiny border-radius-0" name="r_policy[bn]" placeholder="Enter text ...">{!! $data->where('name', 'r_policy') ? $data->where('name', 'r_policy')->first()->bn : null !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <div class="pd-20 card-box mb-30">
                        <div class="row d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary ">Add Product</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Export Datatable End -->
@endsection
@push('js')
    <script src="{{ asset('static/b/vendors/scripts/tinymce/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: '.tiny'
        });
    </script>
@endpush
