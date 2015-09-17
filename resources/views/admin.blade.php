<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title') @lang('meta.title.admin')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('static/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/admin.css') }}">
    @yield('styles')
</head>
<body class="skin-blue">
<div class="wrapper">

    <header class="main-header">
        @include('layout.admin.header')
    </header>

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            @include('layout.admin.sidebar')
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <!-- Pjax container since AdminLTE does not use $.on() delegation -->
    <div class="content-wrapper" data-pjax>

        <section class="content-header">
            {!! Breadcrumbs::renderIfExists() !!}
        </section>

       @yield('content')
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        @include('layout.admin.footer')
    </footer>
</div><!-- ./wrapper -->

<script type="text/javascript" src="{{ asset('static/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/js/admin.js') }}"></script>
@yield('scripts')
</body>
</html>