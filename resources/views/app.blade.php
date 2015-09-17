<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title') @lang('meta.title.app')</title>

    <meta name="keywords" content="@yield('keywords', trans('meta.keywords.app'))">
    <meta name="description" content="@yield('description', trans('meta.description.app'))">
    <meta name="robots" content="index,follow">

    <link rel="stylesheet" href="{{ asset('static/css/frontend.css') }}">
</head>
<body>
    {{-- Includes the site's main flyout menu --}}
    @include('layout.app.menu')

    <div id="wrap" data-pjax>
        {{-- Includes the top navigation layer and site hero section --}}
        @include('layout.app.header')

        @if(Breadcrumbs::exists())
        <section id="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        {!! Breadcrumbs::render() !!}
                    </div>
                </div>
            </div>
        </section>
        @endif

        {{-- Site main content --}}
        <div class="container content">

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

        @include('layout.app.footer')
    </div>

    <script type="text/javascript" src="{{ asset('static/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
