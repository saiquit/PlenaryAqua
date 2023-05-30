<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>Plenary Aqua | Dashboard</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('static/b/vendors/images/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('static/b/vendors/images/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('static/b/vendors/images/favicon-16x16.png') }}" />

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

<body class="sidebar-light">
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


    @include('layouts.backend.parts.header')
    @include('layouts.backend.parts.sidebar')
    <div class="main-container">
        <div class="pd-ltr-20">
            @yield('main')
            <div class="footer-wrap pd-20 mb-20 card-box">
                Plenary Aqua
                <a href="https://github.com/saiquit/PlenaryAqua.git" target="_blank">Saiquit</a>
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
    <script>
        $(document).ready(function() {
            $('.user-notification').click(function(e) {
                e.preventDefault();
                $.get("{{ route('admin.read') }}", {},
                    function(data, textStatus, jqXHR) {
                        if (jqXHR.status == 200) {
                            $('.badge.notification-active').remove();
                        }
                    },
                );
            });
        });
    </script>
    @stack('js')
</body>

</html>
