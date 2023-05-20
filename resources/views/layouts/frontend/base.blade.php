<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Plenary Aqua | @yield('title')</title>
    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('static/f/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('static/f/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('static/f/favicon-16x16.png') }}" />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('static/f/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('build/assets/rfront-84c8e029.css') }}" type="text/css">
    {{-- @vite(['resources/css/rfront.css']) --}}
    @stack('css')

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @include('layouts.frontend.parts.nav')
    @if (Route::is('front.home'))
        @include('layouts.frontend.parts.home_navigation_hero')
    @else
        @include('layouts.frontend.parts.other_navigation_hero')
    @endif
    @yield('main')
    @include('layouts.frontend.parts.footer')
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
    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "671343526235224");
        chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v16.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Js Plugins -->
    {{-- <script>
        var botmanWidget = {
            aboutText: 'Hi',
            introMessage: "✋ Hi! I'm form ItSolutionStuff.com"
        };
    </script> --}}
    <script src="{{ asset('static/f/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('static/f/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('static/f/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('static/f/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('static/f/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('static/f/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('static/f/js/owl.carousel.min.js') }}"></script>
    {{-- <script src="{{ asset('static/f/js/alpine.min.js') }}"></script> --}}
    <script src="{{ asset('static/f/js/main.js') }}"></script>
    <script src="{{ asset('build/assets/front-971931a0.js') }}"></script>
    {{-- <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script> --}}
    {{-- @vite(['resources/js/front.js']) --}}
    <script>
        $(document).ready(function() {
            $($('.alert-dismissible').get().reverse()).each(function(indexInArray, valueOfElement) {
                $(this).delay(2000 * (indexInArray + 1)).fadeOut(1000);
            });
        });
    </script>
    @stack('js')
</body>

</html>
