<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="{{ asset('front/img/apple-icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/templatemo.css') }}">
    <link rel="stylesheet" href="{{ asset('front/css/custom.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('front/css/fontawesome.min.css') }}">
</head>

<body>
@include('front._layout.navbar')

@yield('content')

<footer class="bg-dark" id="tempaltemo_footer">
    <x-configs-list />

    <div class="w-100 bg-black py-3">
        <div class="container">
            <div class="row pt-2">
                <div class="col-12">
                    <p class="text-left text-light">
                        Copyright &copy; {{ now()->year }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="{{ asset('front/js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('front/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('front/js/templatemo.js') }}"></script>
<script src="{{ asset('front/js/custom.js') }}"></script>
@stack('js')
</body>
</html>
