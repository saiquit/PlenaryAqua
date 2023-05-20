@extends('layouts.backend.base')
@push('css')
    <!-- Slick Slider css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/src/plugins/slick/slick.css') }}" />
    <!-- bootstrap-touchspin css -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('static/b/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
@endpush
@section('main')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-11 col-sm-12">
                    <div class="title">
                        <h4>Variation Detail</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $variation->product->name_en }}
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
        <div class="product-wrap">
            <div class="product-detail-wrap mb-30">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="product-detail-desc pd-20 card-box height-100-p">
                            <h4 class="mb-20 pt-20">{{ $variation->name_en }}</h4>
                            <p>{{ $variation->desc_en }}</p>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Net Weight</th>
                                        <th scope="col">Gross Weight</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Discounted From Price</th>
                                        <th scope="col">Discount Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">{{ $variation->stock }}</th>
                                        <td scope="row">{{ $variation->weight }}</th>
                                        <td scope="row">{{ $variation->gross_weight }}</th>
                                        <td scope="row">{{ $variation->price }}</th>
                                        <td scope="row">{{ $variation->discounted_from_price }}</th>
                                        <td scope="row">{{ $variation->discount }}%</th>
                                    </tr>
                                </tbody>
                            </table>
                            <a class="float-right" href="{{ route('admin.variations.edit', $variation) }}"><button
                                    class="btn btn-primary">Edit</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Slick Slider js -->
    <script src="{{ asset('static/b/src/plugins/slick/slick.min.js') }}"></script>
    <!-- bootstrap-touchspin js -->
    <script src="{{ asset('static/b/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".product-slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: true,
                infinite: true,
                speed: 1000,
                fade: true,
                asNavFor: ".product-slider-nav",
            });
            jQuery(".product-slider-nav").slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: ".product-slider",
                dots: false,
                infinite: true,
                arrows: false,
                speed: 1000,
                centerMode: true,
                focusOnSelect: true,
            });
            $("input[name='demo3_22']").TouchSpin({
                initval: 1,
            });
        });
    </script>
@endpush
