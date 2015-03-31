@extends('user::admin.index')

@section('title')
    @lang('user::user.title.edit')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('user::user.title.edit')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::model($user, [
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-message' => trans('user::user.save.success'),
            'data-remote-error-message' => trans('user::user.save.error'),
            'method' => 'PUT',
            'route' => ['user.admin.users.update', $user->id]]) !!}

            @include('user::admin.statistic')

            @include('user::admin.users.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection