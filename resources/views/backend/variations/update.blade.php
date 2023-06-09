@extends('layouts.backend.base')

@section('main')
    <form action="{{ route('admin.variations.update', $variation) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Update Product</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a
                                        href="{{ route('admin.products.show', $variation->product) }}">{{ $variation->product->name_en }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $variation->name_en }}
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
                        <div class="col-12 col-md-12">
                            <div class="form-group">
                                <label>Product</label>
                                <input readonly class="form-control" type="text"
                                    placeholder="{{ $variation->product->name_en }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Distict</label>
                                <input readonly class="form-control" type="text"
                                    placeholder="{{ $variation->district->name_en }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Net Weight</label>
                                <input name="weight" value="{{ $variation->weight }}" class="form-control" type="text"
                                    placeholder="Weight">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Gross Weight</label>
                                <input name="gross_weight" value="{{ $variation->gross_weight }}" class="form-control"
                                    type="text" placeholder="Gross Weight">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input name="price" value="{{ $variation->price }}" class="form-control" type="number"
                                    placeholder="price">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Stock</label>
                                <input name="stock" value="{{ $variation->stock }}" class="form-control" type="number"
                                    placeholder="stock">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Discountend From</label>
                                <input name="discounted_from_price" value="{{ $variation->discounted_from_price }}"
                                    class="form-control" type="number" placeholder="Discounted From Price">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Discountend Percent %</label>
                                <input name="discount" value="{{ $variation->discount }}" class="form-control"
                                    type="number" placeholder="discount">
                            </div>
                        </div>
                        <div class="w-100 border my-4"></div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Variation Name (English)</label>
                                <input value="{{ $variation->name_en }}" name="variation_name_en" class="form-control"
                                    type="text" placeholder="Variation Name">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>ভেরিয়েশন নাম</label>
                                <input value="{{ $variation->name_bn }}" name="variation_name_bn" class="form-control"
                                    type="text" placeholder="ভেরিয়েশন নাম">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>Variation Decription (English)</label>
                                <textarea name="variation_desc_en" class="form-control" data-lt-tmp-id="lt-72920" spellcheck="false" data-gramm="false">{{ $variation->desc_en }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <label>ভেরিয়েশন বর্ণনা</label>
                                <textarea class="form-control" name="variation_desc_bn" data-lt-tmp-id="lt-72920" spellcheck="false" data-gramm="false">{{ $variation->desc_bn }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Select Tags</label>
                                <select class="custom-select2 form-control" multiple style="width: 100%" name="tags[]">
                                    @foreach (App\Models\Tag::all() as $tag)
                                        <option @if ($variation->tags->contains('id', $tag->id)) selected="selected" @endif
                                            value="{{ $tag->id }}">
                                            {{ $tag->name_en }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-md-6" style="padding: 1rem">
                            <div class="col-12 card border-danger">
                                <div class="row mb-20 mt-30">
                                    <div class="col-8">
                                        <h4 class="">Price and Stock In Khulna</h4>
                                    </div>
                                    <div class="col-4">
                                        <input @checked($variation->districts()->find('2')) name="khulna_active" type="checkbox"
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
                                            <input
                                                @if ($variation->districts->find(2)) value="{{ $variation->districts->where('id', 2)->first()['pivot']['price'] }}" @endif
                                                name="khulna_price" class="form-control" type="text" placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Discounted From Price</label>
                                        </div>
                                        <div class="col-8">
                                            <input
                                                @if ($variation->districts->find(2)) value="{{ $variation->districts->where('id', 2)->first()['pivot']['discounted_from_price'] }}" @endif
                                                name="khulna_discount" class="form-control" type="text"
                                                placeholder="Discounted From Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Discount %</label>
                                        </div>
                                        <div class="col-8">
                                            <input
                                                @if ($variation->districts->find(2)) value="{{ $variation->districts->where('id', 2)->first()['pivot']['discount'] }}" @endif
                                                name="khulna_discount_pc" class="form-control" type="text"
                                                placeholder="Discount %">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Stock</label>
                                        </div>
                                        <div class="col-8">
                                            <input
                                                @if ($variation->districts->find(2)) value="{{ $variation->districts->where('id', 2)->first()['pivot']['stock'] }}" @endif
                                                name="khulna_stock" class="form-control" type="text"
                                                placeholder="Stock">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6" style="padding: 1rem">
                            <div class="col-12 card border-info">
                                <div class="row mb-20 mt-30">
                                    <div class="col-8">
                                        <h4 class="">Price and Stock In Dhaka</h4>
                                    </div>
                                    <div class="col-4">
                                        <input @checked($variation->districts()->find('1')) name="dhaka_active" type="checkbox"
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
                                            <input
                                                @if ($variation->districts->find(1)) value="{{ $variation->districts->where('id', 1)->first()['pivot']['price'] }}" @endif
                                                name="dhaka_price" class="form-control" type="text"
                                                placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Discounted From Price</label>
                                        </div>
                                        <div class="col-8">
                                            <input
                                                @if ($variation->districts->find(1)) value="{{ $variation->districts->where('id', 1)->first()['pivot']['discounted_from_price'] }}" @endif
                                                name="dhaka_discount" class="form-control" type="text"
                                                placeholder="Discounted From Price">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Discount %</label>
                                        </div>
                                        <div class="col-8">
                                            <input
                                                @if ($variation->districts->find(1)) value="{{ $variation->districts->where('id', 1)->first()['pivot']['discount'] }}" @endif
                                                name="dhaka_discount_pc" class="form-control" type="text"
                                                placeholder="Discount %">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-4">
                                            <label>Stock</label>
                                        </div>
                                        <div class="col-8">
                                            <input
                                                @if ($variation->districts->find(1)) value="{{ $variation->districts->where('id', 1)->first()['pivot']['stock'] }}" @endif
                                                name="dhaka_stock" class="form-control" type="text"
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
                    <button type="submit" class="btn btn-primary ">Update Variation</button>
                </div>
            </div>
        </div>
    </form>
@endsection
