<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/static/b/vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/static/b/vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/static/b/vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/vendors/styles/icon-font.min.css') }}" />
    @stack('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('static/b/vendors/styles/style.css') }}" />

</head>

<body>
    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="/static/b/vendors/images/new-loader.gif" alt="" />
            </div>
            {{-- <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div> --}}
        </div>
    </div>


    @include('layouts.backend.parts.header')
    @include('layouts.backend.parts.sidebar')
    <div class="main-container">
        <div class="pd-ltr-20">
            @yield('main')
            <div class="footer-wrap pd-20 mb-20 card-box">
                DeskApp - Bootstrap 4 Admin Template By
                <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="{{ asset('static/b/vendors/scripts/core.min.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/script.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('static/b/vendors/scripts/layout-settings.js') }}"></script>
    @stack('js')
</body>

</html>
