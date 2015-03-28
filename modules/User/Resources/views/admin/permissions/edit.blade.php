@extends('user::admin.index')

@section('title')
    @lang('user::permission.title.edit')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('user::permission.title.edit')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::model($permission, [
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-message' => trans('user::permission.save.success'),
            'data-remote-error-message' => trans('user::permission.save.error'),
            'method' => 'PUT',
            'route' => ['user.admin.permissions.update', $permission->id]]) !!}

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

        @include('user::admin.permissions.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection