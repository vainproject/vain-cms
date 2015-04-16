<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') @lang('meta.title.app')</title>

    <meta name="keywords" content="@yield('keywords', trans('meta.keywords.app'))">
    <meta name="description" content="@yield('description', trans('meta.description.app'))">
    <meta name="robots" content="index,follow">

    <link rel="stylesheet" href="{{ asset('static/css/app.css') }}">
</head>
<body>
<div class="wrapper" data-pjax>
    @include('layout.app.menu')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>
<script type="text/javascript" src="{{ asset('static/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
