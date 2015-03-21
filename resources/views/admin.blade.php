<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title') @lang('meta.title.admin')</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ elixir("static/css/app.css") }}">
    <link rel="stylesheet" href="{{ elixir("static/css/admin.css") }}">
    @yield('styles')
</head>
<body class="skin-blue">
<!-- Site wrapper -->
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
    <div class="content-wrapper">
       @yield('content')
    </div><!-- /.content-wrapper -->

    <footer class="main-footer">
        @include('layout.admin.footer')
    </footer>
</div><!-- ./wrapper -->

<script type="text/javascript" src="{{ elixir("static/js/app.js") }}"></script>
<script type="text/javascript" src="{{ elixir("static/js/admin.js") }}"></script>
@yield('scripts')
</body>
</html>