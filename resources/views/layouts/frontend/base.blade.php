<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Plenary Aqua">
    <meta name="keywords"
        content="Plenary Aqua, plenary, aqua, fish, {{ join(', ',request()->categories->pluck('name_en')->toArray()) }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('meta')
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
    <link rel="stylesheet" href="{{ asset('static/f/css/style.min.css') }}" type="text/css">
    {{-- @vite(['resources/css/rfront.css']) --}}
    @stack('css')

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <svg class="loader" role="img"
            aria-label="Mouth and eyes come from 9:00 and rotate clockwise into position, right eye blinks, then all parts rotate and merge into 3:00"
            class="smiley" viewBox="0 0 128 128" width="128px" height="128px">
            <defs>
                <clipPath id="smiley-eyes">
                    <circle class="smiley__eye1" cx="64" cy="64" r="8"
                        transform="rotate(-40,64,64) translate(0,-56)" />
                    <circle class="smiley__eye2" cx="64" cy="64" r="8"
                        transform="rotate(40,64,64) translate(0,-56)" />
                </clipPath>
                <linearGradient id="smiley-grad" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="#000" />
                    <stop offset="100%" stop-color="#fff" />
                </linearGradient>
                <mask id="smiley-mask">
                    <rect x="0" y="0" width="128" height="128" fill="url(#smiley-grad)" />
                </mask>
            </defs>
            <g stroke-linecap="round" stroke-width="12" stroke-dasharray="175.93 351.86">
                <g>
                    <rect fill="#1a632d" width="128" height="64" clip-path="url(#smiley-eyes)" />
                    <g fill="none" stroke="#1a632d">
                        <circle class="smiley__mouth1" cx="64" cy="64" r="56"
                            transform="rotate(180,64,64)" />
                        <circle class="smiley__mouth2" cx="64" cy="64" r="56"
                            transform="rotate(0,64,64)" />
                    </g>
                </g>
                <g mask="url(#smiley-mask)">
                    <rect fill="#1a632d" width="128" height="64" clip-path="url(#smiley-eyes)" />
                    <g fill="none" stroke="#1a632d">
                        <circle class="smiley__mouth1" cx="64" cy="64" r="56"
                            transform="rotate(180,64,64)" />
                        <circle class="smiley__mouth2" cx="64" cy="64" r="56"
                            transform="rotate(0,64,64)" />
                    </g>
                </g>
            </g>
        </svg>
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
    <script src="{{ asset('static/f/js/main.min.js') }}"></script>
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
