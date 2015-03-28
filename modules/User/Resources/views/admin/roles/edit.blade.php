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
            'route' => ['user.admin.roles.edit', $role->id]]) !!}

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

        @include('user::admin.roles.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection