<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet"> -->

    <link rel="stylesheet" href="{{ asset('public/auth/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('public/auth/css/owl.carousel.min.css')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('public/auth/css/bootstrap.min.css')}}">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('public/auth/css/style.css')}}">

    <title>{{ $title }}</title>
</head>

<body>
    <div class="content">
        @yield('container')
    </div>
<script src="{{ asset('public/auth/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('public/auth/js/popper.min.js')}}"></script>
<script src="{{ asset('public/auth/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('public/auth/js/main.js')}}"></script>
</body>

</html>