@extends('layouts.frontend.base')
@section('title')
    Wish List
@endsection
@section('main')
    <div class="cart-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-heading mb-10">
                        <div class="section-title">
                            <h2>My Wishlist</h2>
                        </div>
                    </div>
                    <div class="table-wishlist">
                        <table cellpadding="0" cellspacing="0" border="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Name</th>
                                    <th>Available Variations</th>
                                    <th>Actions</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($wishes->count())
                                    @foreach ($wishes as $wish)
                                        <tr class="my-4">
                                            <td>
                                                <div class="display-flex align-center">
                                                    <div class="img-product">
                                                        <img width="150"
                                                            src="{{ isset($variation->product->images[0]->filename) ? url('storage/' . $variation->product->images[0]->filename) : asset('static/f/img/product/product-1.jpg') }}"
                                                            alt="">
                                                    </div>

                                                </div>
                                            </td>
                                            <td class="price"> {{ $wish['name_' . app()->getLocale()] }}</td>
                                            <td class="price"> {{ $wish->variations->count() }}</td>
                                            <td>
                                                <a href="{{ route('front.single', ['slug' => $wish->slug]) }}"
                                                    target="_blank" rel="noopener noreferrer"><button
                                                        class="btn btn-primary">Show
                                                        Product</button></a>
                                                <a onclick="document.querySelector('#form-{{ $wish->id }}').submit()"><button
                                                        class="btn btn-danger">Remove</button></a>
                                                <form hidden id="form-{{ $wish->id }}"
                                                    action="{{ route('front.store_love', ['product' => $wish->id]) }}"
                                                    method="post">
                                                    @csrf
                                                </form>
                                            </td>
                                            <td class="text-center"><a href="#" class="trash-icon"><i
                                                        class="far fa-trash-alt"></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <div class="alert alert-danger">No Wish Products Yet!</div>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
