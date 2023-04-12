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
                <div class="col-md-10 col-sm-12">
                    <div class="title">
                        <h4>Product Detail</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $product->name_en }}
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-2 col-sm-12">
                    <a class="btn btn-warning float-right"
                        href="{{ route('admin.products.update', $product->id) }}">Edit</a>
                </div>
            </div>
        </div>
        <div class="product-wrap">
            <div class="product-detail-wrap mb-30">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="product-slider slider-arrow">
                            @foreach ($product->images as $image)
                                <div class="product-slide">
                                    <img src="{{ url('storage/' . $image->filename) }}" alt="" />
                                </div>
                            @endforeach
                        </div>
                        <div class="product-slider-nav">
                            @foreach ($product->images as $image)
                                <div class="product-slide-nav">
                                    <img src="{{ url('storage/' . $image->filename) }}" alt="" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="product-detail-desc pd-20 card-box height-100-p">
                            <h4 class="mb-20 pt-20">{{ $product->name_en }}</h4>
                            <p>{{ $product->desc_en }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between card-box p-3 my-3">
                <h4 class="mb-20">Recent Product</h4>
                <a class="btn btn-primary" href="{{ route('admin.variations.create', ['product_id' => 1]) }}">Create new
                    varaiation</a>
            </div>
            <div class="product-list">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Variations</h4>
                    </div>
                    <div class="pb-20">
                        <table class="data-table table stripe hover nowrap">
                            <thead>
                                <tr>
                                    <th class="table-plus datatable-nosort">Image</th>
                                    <th class="table-plus datatable-nosort">Name</th>
                                    <th>Weight</th>
                                    <th>Price (Tk)</th>
                                    <th>stock</th>
                                    <th>Start Date</th>
                                    <th class="datatable-nosort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->variations as $variation)
                                    <tr>
                                        <td><img src="{{ url('storage/' . $variation->images[0]->filename) }}"
                                                width="80" alt=""></td>
                                        <td class="table-plus">{{ $variation->name_en }}</td>
                                        <td>{{ $variation->weight }}</td>
                                        <td>
                                            @foreach ($variation->districts as $item)
                                                <div> {{ $item->name_en }}: <b>{{ $item->pivot->price }} tk</b></div>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($variation->districts as $item)
                                                <div> {{ $item->name_en }}: <b>{{ $item->pivot->stock }}</b></div>
                                            @endforeach
                                        </td>
                                        <td>{{ $variation->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                    href="#" role="button" data-toggle="dropdown">
                                                    <i class="dw dw-more"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.variations.show', $variation) }}"><i
                                                            class="dw dw-eye"></i>
                                                        View</a>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.variations.edit', $variation) }}"><i
                                                            class="dw dw-edit2"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item"
                                                        onclick="document.querySelector('#delete_{{ $variation->id }}').submit()"><i
                                                            class="dw dw-delete-3"></i>
                                                        Delete</a>
                                                    <form id="delete_{{ $variation->id }}"
                                                        action="{{ route('admin.variations.destroy', $variation) }}"
                                                        method="POST" hidden>
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('static/b/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/datatable-setting.js') }}"></script>

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
