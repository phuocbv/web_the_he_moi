<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">
    <script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('bower_components/simplePagination.js/jquery.simplePagination.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/simplePagination.js/simplePagination.css') }}"/>
</head>
<body>
    @include('layouts.header')
    @yield('content')
    <script src="{{ asset('/js/myapp.js') }}"></script>
    <script>
        var myApp = new myApp;
        myApp.init();
    </script>
</body>
</html>
