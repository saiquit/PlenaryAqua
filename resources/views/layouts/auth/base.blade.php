<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plenary Aqua</title>
    <link rel="stylesheet" href="{{ asset('static/f/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('static/f/css/jquery-ui.min.css') }}" type="text/css">
    @stack('css')
</head>

<body>
    @yield('main')
    @if (Session::has('message'))
        <div style="position: fixed;bottom: 0px;z-index: 100;width: 100%;margin: 0;"
            class="text-center alert-dismissible fade show alert {{ Session::get('type', 'alert-info') }}">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <script src="{{ asset('static/f/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('static/f/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('static/f/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('static/f/js/jquery-ui.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.alert-dismissible').delay(5000).fadeOut(1000);
        });
    </script>
    @stack('js')
</body>

</html>
