@extends('blog::admin.index')

@section('title')
    @lang('blog::admin.categories.title.create')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('blog::admin.categories.title.create')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open([
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-redirect' => route('blog.admin.categories.index'),
            'data-remote-error-message' => trans('blog::admin.categories.save.error'),
            'route' => ['blog.admin.categories.store']]) !!}

        @include('blog::admin.categories.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection