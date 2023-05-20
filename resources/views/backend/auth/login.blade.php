<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Login</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/static/b//static/b/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/static/b//static/b/vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/static/b//static/b/vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/vendors/styles/icon-font.min.css') }}" />
    @stack('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/vendors/styles/style.min.css') }}" />

</head>

<body class="login-page">
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="{{ asset('/static/b/vendors/images/logo.png') }}" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>

    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="{{ route('front.home') }}">
                    <img src="/static/b/vendors/images/logo.png" alt="" />
                </a>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-md-12 col-lg-12">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Login To Plenary</h2>
                        </div>
                        <form action="{{ route('admin.auth.do_login') }}" method="POST">
                            @csrf
                            <div class="input-group custom">
                                <input name="email" type="email" class="form-control form-control-lg"
                                    placeholder="example@example.com" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="input-group custom">
                                <input name="password" type="password" class="form-control form-control-lg"
                                    placeholder="**********" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="row pb-30">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input name="remember" type="checkbox" class="custom-control-input"
                                            id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1">Remember</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Session::has('message'))
        <div style="position: fixed;bottom: 0px;z-index: 100;width: 100%;margin: 0;"
            class="text-center alert-dismissible fade show alert {{ Session::get('type', 'alert-info') }}">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @foreach ($errors->all() as $key => $error)
        <div style="position: fixed;bottom: {{ $key * 3.3 }}rem;z-index: 100;width: 100%;margin: 0;"
            class="text-center alert-dismissible fade show alert alert-danger">
            <b>{{ $error }}</b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
    <!-- js -->
    <script src="{{ asset('static/b/vendors/scripts/core.min.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/script.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/layout-settings.js') }}"></script>
    @stack('js')
</body>

</html>
