@extends('layouts.auth.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('static/f/css/auth.min.css') }}">
@endpush
@section('main')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form action="{{ route('register') }}" method="POST" class="login100-form validate-form">
                    @csrf
                    <a href="{{ route('front.home') }}">
                        <img src="{{ asset('static/f/img/logo.png') }}" class="d-block mx-auto" alt=""
                            srcset="">
                    </a>
                    <span class="login100-form-title p-b-43">
                        Register
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Valid name is required: Md S...">
                        <input class="input100" type="text" name="name">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Name</span>
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="wrap-input100 validate-input" data-validate="Valid phone is required: +8801......">
                        <input class="input100" type="text" name="phone">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Phone</span>
                    </div>
                    @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password_confirmation">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Confirm Password</span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>
                    <a href="{{ route('login') }}">
                        <div class="container-login100-form-btn  pt-4">
                            <p>Already have an account?</p>
                            <button type="button" class="login100-form-btn bg-secondary">
                                Login
                            </button>
                        </div>
                    </a>
                    {{-- <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            or sign up using
                        </span>
                    </div>
                    <div class="login100-form-social flex-c-m">
                        <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                    </div> --}}
                </form>
                <div class="login100-more"
                    style="background-image: url('https://www.eatthis.com/wp-content/uploads/sites/4/2021/09/salmon-2.jpg?quality=82&strip=1');">
                </div>
            </div>
        </div>
    </div>
@endsection
