<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <meta name="robots" content="index,follow">

    <link rel="stylesheet" href="{{ elixir("static/css/app.css") }}">
</head>
<body>
    @include('layout.app.menu')

    @yield('content')

    <script type="text/javascript" src="{{ elixir("static/js/app.js") }}"></script>
</body>
</html>
