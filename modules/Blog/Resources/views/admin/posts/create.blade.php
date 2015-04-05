@extends('blog::admin.index')

@section('title')
    @lang('blog::admin.posts.title.create')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('blog::admin.posts.title.create')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open([
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-redirect' => route('blog.admin.posts.index'),
            'data-remote-error-message' => trans('blog::admin.posts.save.error'),
            'route' => ['blog.admin.posts.store']]) !!}

        @include('blog::admin.posts.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection