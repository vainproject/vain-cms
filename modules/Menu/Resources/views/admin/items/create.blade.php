@extends('admin')

@section('title')
    @lang('menu::menu.title.create')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('menu::menu.title.create')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open([
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-redirect' => route('menu.admin.items.index'),
            'data-remote-error-message' => trans('menu::menu.save.error'),
            'route' => 'menu.admin.items.store']) !!}

        @include('menu::admin.items.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection