@extends('admin')

@section('title')
    @lang('menu::menu.title.edit')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('menu::menu.title.edit')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::model($menu, [
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-message' => trans('menu::menu.save.success'),
            'data-remote-error-message' => trans('menu::menu.save.error'),
            'method' => 'PUT',
            'route' => ['menu.admin.items.update', $menu->id]]) !!}

        @include('menu::admin.items.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection