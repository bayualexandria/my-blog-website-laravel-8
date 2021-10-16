<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ url('assets/images/web/logo-circle.png') }}">
    <title>{{ $title??env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.css') }}">
    @yield('styles')    
    <link rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    @yield('content')
    <script src="{{ url('assets/js/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/app.js') }}"></script>
    @yield('scripts')
    <script src="{{ url('assets/js/main.js') }}"></script>
</body>

</html>