@extends('layouts.backend.base')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/src/plugins/switchery/switchery.min.css') }}" />
@endpush
@section('main')
    <form enctype="multipart/form-data" action="{{ route('admin.variations.store') }}" method="POST">
        @csrf
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Create Variation</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <h4>
                                        Product Name: <b class="text-blue text-uppercase">{{ $product->name_en }}</b>
                                    </h4>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="pd-20 card-box mb-30">
                <div class="clearfix"></div>
                <div class="form">
                    <div class="row card-box pd-30 mb-15">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product</label>
                                <input readonly class="form-control" type="text" placeholder="{{ $product->name_en }}">
                                <input hidden name="product" class="form-control" type="text"
                                    value="{{ $product->id }}">
                            </div>

                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Net Weight</label>
                                <input name="weight" class="form-control" type="text" placeholder="Net Weight">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Gross Weight</label>
                                <input name="gross_weight" class="form-control" type="text" placeholder="Gross Weight">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Variation Name (English)</label>
                                <input name="variation_name_en" class="form-control" type="text"
                                    placeholder="Variation Name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>ভেরিয়েশন নাম</label>
                                <input name="variation_name_bn" class="form-control" type="text"
                                    placeholder="ভেরিয়েশন নাম">
                            </div>
                        </div>
                        <div class="col-12 ">
                            <div class="form-group">
                                <label>Select Tags</label>
                                <select class="custom-select2 form-control" multiple style="width: 100%" name="tags[]">
                                    @foreach (App\Models\Tag::all() as $tag)
                                        <option value="{{ $tag->id }}">
                                            {{ $tag->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Variation Decription (English)</label>
                                <textarea name="variation_desc_en" class="form-control" data-lt-tmp-id="lt-72920" spellcheck="false" data-gramm="false"></textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>ভেরিয়েশন বর্ণনা</label>
                                <textarea class="form-control" name="variation_desc_bn" data-lt-tmp-id="lt-72920" spellcheck="false" data-gramm="false"></textarea>
                            </div>
                        </div>

                        @foreach (['khulna', 'dhaka'] as $d)
                            <div class="col-12 col-md-6" style="padding: 1rem">
                                <div class="col-12 card border-danger">
                                    <div class="row mb-20 mt-30">
                                        <div class="col-8">
                                            <h4 class="">Price and Stock In {{ ucfirst($d) }}</h4>
                                        </div>
                                        <div class="col-4">
                                            <input name="vars[{{ $d }}][active]" type="checkbox"
                                                class="switch-btn" data-size="small" data-color="#0099ff"
                                                style="display: none; color: rgb(0, 153, 255);" data-switchery="true">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="items">
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label>Price</label>
                                            </div>
                                            <div class="col-8">
                                                <input name="vars[{{ $d }}][price]" class="form-control"
                                                    type="text" placeholder="Price">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label>Discounted From Price</label>
                                            </div>
                                            <div class="col-8">
                                                <input name="vars[{{ $d }}][discount]" class="form-control"
                                                    type="text" placeholder="Discounted From Price">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label>Discount %</label>
                                            </div>
                                            <div class="col-8">
                                                <input name="vars[{{ $d }}][discount_pc]" class="form-control"
                                                    type="text" placeholder="Discount %">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-4">
                                                <label>Stock</label>
                                            </div>
                                            <div class="col-8">
                                                <input name="vars[{{ $d }}][stock]" class="form-control"
                                                    type="text" placeholder="Stock">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="col-12 col-md-6" style="padding: 1rem">
                            <div class="col-12 card border-info">
                                <div class="row mb-20 mt-30">
                                    <div class="col-8">
                                        <h4 class="">Price and Stock In Dhaka</h4>
                                    </div>
                                    <div class="col-4">
                                        <input name="dhaka_active" type="checkbox" class="switch-btn" data-size="small"
                                            data-color="#0099ff" style="display: none; color: rgb(0, 153, 255);"
                                            data-switchery="true">
                                    </div>
                                </div>
                                <br>
                                <div class="items">
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Price</label>
                                        </div>
                                        <div class="col-8">
                                            <input name="dhaka_price" class="form-control" type="text"
                                                placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Discounted From Price</label>
                                        </div>
                                        <div class="col-8">
                                            <input name="dhaka_discount" class="form-control" type="text"
                                                placeholder="Discounted From Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Discount %</label>
                                        </div>
                                        <div class="col-8">
                                            <input name="dhaka_discount_pc" class="form-control" type="text"
                                                placeholder="Discount %">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Stock</label>
                                        </div>
                                        <div class="col-8">
                                            <input name="dhaka_stock" class="form-control" type="text"
                                                placeholder="Stock">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="pd-20 card-box mb-30">
                <div class="row d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary ">Add Variation</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="{{ asset('static/b/src/plugins/switchery/switchery.min.js') }}"></script>
    <script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
        $('.switch-btn').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        $('.items').hide()
        $('.switch-btn').on('change', function() {
            if ($(this).is(':checked')) {
                $(this).parent().parent().siblings('.items').show()
            } else {
                $(this).parent().parent().siblings('.items').hide()
            }
        })
    </script>
@endpush
