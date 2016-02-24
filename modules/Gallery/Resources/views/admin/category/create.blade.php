@extends('gallery::admin.index')

@section('title')
    @lang('gallery::admin.category.title.create')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('gallery::admin.category.title.create')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open([
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-redirect' => route('gallery.admin.category.index'),
            'data-remote-error-message' => trans('gallery::admin.category.save.error'),
            'route' => ['gallery.admin.category.store']]) !!}

        @include('gallery::admin.category.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection