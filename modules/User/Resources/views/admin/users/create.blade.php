@extends('user::admin.index')

@section('title')
    @lang('user::user.title.create')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('user::user.title.create')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open([
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-redirect' => route('user.admin.users.index'),
            'data-remote-error-message' => trans('user::user.save.error'),
            'route' => ['user.admin.users.store']]) !!}

        @include('user::admin.users.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection