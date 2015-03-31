@extends('user::admin.index')

@section('title')
    @lang('user::role.title.edit')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('user::role.title.edit')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::model($role, [
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-message' => trans('user::role.save.success'),
            'data-remote-error-message' => trans('user::role.save.error'),
            'method' => 'PUT',
            'route' => ['user.admin.roles.update', $role->id]]) !!}

        @include('user::admin.roles.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection