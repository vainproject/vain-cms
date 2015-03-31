@extends('user::admin.index')

@section('title')
    @lang('user::permission.title.create')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('user::permission.title.create')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open([
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-redirect' => route('user.admin.permissions.index'),
            'data-remote-error-message' => trans('user::permission.save.error'),
            'route' => ['user.admin.permissions.store']]) !!}

        @include('user::admin.permissions.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection