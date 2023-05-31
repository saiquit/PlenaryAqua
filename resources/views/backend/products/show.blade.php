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
                    <a class="btn btn-warning float-right" href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
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
                            <p>{!! $product->desc_en !!}</p>
                            <div class="pd-20 card-box ">
                                <h4 class="mb-20 h4">Latest Comments</h4>
                                <div class="list-group">
                                    @foreach ($product->comments->slice(0, 2) as $comment)
                                        <a href="#"
                                            class="list-group-item list-group-item-action flex-column align-items-start">
                                            <h5 class="mb-1 h5">{{ $comment->comment }}</h5>
                                            <div class="pb-1">
                                                <small
                                                    class="weight-600">{{ $comment->created_at->diffForHumans() }}</small>
                                            </div>
                                            <p class="mb-1 font-14">
                                                {{ $comment->user->name }}
                                            </p>
                                            {{-- <small>Donec id elit non mi porta.</small> --}}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between card-box p-3 my-3">
                <h4 class="mb-20">Variation Section</h4>
                <a class="btn btn-primary"
                    href="{{ route('admin.variations.create', ['product_id' => $product->id]) }}">Create new
                    varaiation</a>
            </div>
            <div class="product-list">
                <div class="card-box mb-30">
                    <div class="pd-20">
                        <h4 class="text-blue h4">Posted Variations</h4>
                    </div>
                    <div class="pb-20">
                        <div class="tab">
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#dhaka" role="tab"
                                        aria-selected="true">Dhaka</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#khulna" role="tab"
                                        aria-selected="false">Khulna</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                @foreach ($variation_groups as $key => $variations)
                                    <div class="tab-pane fade show @if ($key == 1) active @endif"
                                        @switch($key) @case(1) id="dhaka" @break @case(2) id="khulna" @break @default id="dhaka" @endswitch
                                        role="tabpanel">
                                        <div class="pd-20">
                                            <table class="data-table table stripe hover nowrap">
                                                <thead>
                                                    <tr>
                                                        <th class="table-plus datatable-nosort">Name</th>
                                                        <th>Net Weight</th>
                                                        <th>Gross Weight</th>
                                                        <th>Price (Tk)</th>
                                                        <th>Stock</th>
                                                        <th>Start Date</th>
                                                        <th class="datatable-nosort">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($variations as $variation)
                                                        <tr>
                                                            <td class="table-plus">
                                                                <a href="{{ route('admin.variations.show', $variation) }}">
                                                                    {{ $variation->name_en }}
                                                                </a>
                                                            </td>
                                                            <td>{{ $variation->weight }}</td>
                                                            <td>{{ $variation->gross_weight }}</td>
                                                            <td>{{ $variation->price }}</td>
                                                            <td>{{ $variation->stock }}</td>
                                                            <td>{{ $variation->created_at->format('d/m/Y') }}</td>
                                                            <td>
                                                                <div class="dropdown">
                                                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                                                        href="#" role="button"
                                                                        data-toggle="dropdown">
                                                                        <i class="dw dw-more"></i>
                                                                    </a>
                                                                    <div
                                                                        class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
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
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('static/b/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('static/b/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/datatable-setting.js') }}"></script>

    <!-- Slick Slider js -->
    <script src="{{ asset('static/b/src/plugins/slick/slick.min.js') }}"></script>
    <!-- bootstrap-touchspin js -->
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

        });
    </script>
@endpush
