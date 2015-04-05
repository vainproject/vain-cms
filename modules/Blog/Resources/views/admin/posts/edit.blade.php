@extends('blog::admin.index')

@section('title')
    @lang('blog::admin.posts.title.edit')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('blog::admin.posts.title.edit')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::model($post, [
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-message' => trans('blog::admin.posts.save.success'),
            'data-remote-error-message' => trans('blog::admin.posts.save.error'),
            'method' => 'PUT',
            'route' => ['blog.admin.posts.update', $post->id]]) !!}

        @include('blog::admin.posts.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection