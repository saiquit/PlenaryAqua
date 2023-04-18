@extends('layouts.auth.base')

@section('main')
    <div class="container min-vh-100">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <div class="text-center">
                            <a href="{{ route('front.home', []) }}"><img src="/static/f/img/logo.png" alt=""></a>
                        </div>
                        <div class="card-title text-center">
                            <h3>{{ __('Verify Your Email Address') }}</h3>
                        </div>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
