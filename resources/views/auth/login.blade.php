@extends('layouts.auth.base')
@push('css')
    <link rel="stylesheet" href="{{ asset('static/f/css/auth.min.css') }}">
@endpush
@section('main')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form action="{{ route('front.do_login') }}" method="POST" class="login100-form validate-form">
                    @csrf
                    <a href="{{ route('front.home') }}">
                        <img src="{{ asset('static/f/img/logo.png') }}" class="d-block mx-auto" alt=""
                            srcset="">
                    </a>
                    <span class="login100-form-title p-b-43">
                        Login to continue
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" value="{{ old('email') }}" name="email">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" value="{{ old('password') }}" name="password">
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>
                        <div>
                            <a href="#" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>
                    <a href="{{ route('register') }}">
                        <div class="container-login100-form-btn  pt-4">
                            <p>Don't have an account?</p>
                            <button type="button" class="login100-form-btn bg-secondary">
                                Register
                            </button>
                        </div>
                    </a>
                    <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            or sign up using
                        </span>
                    </div>
                    {{-- <div class="login100-form-social flex-c-m">
                        <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                    </div> --}}
                </form>
                <div class="login100-more"
                    style="background-image: url('https://www.hsph.harvard.edu/nutritionsource/wp-content/uploads/sites/30/2021/09/shutterstock_403995229-copy.jpg');">
                </div>
            </div>
        </div>
    </div>
@endsection
