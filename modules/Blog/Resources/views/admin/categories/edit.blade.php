@extends('blog::admin.index')

@section('title')
    @lang('blog::admin.categories.title.edit')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('blog::admin.categories.title.edit')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::model($category, [
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-message' => trans('blog::admin.categories.save.success'),
            'data-remote-error-message' => trans('blog::admin.categories.save.error'),
            'method' => 'PUT',
            'route' => ['blog.admin.categories.update', $category->id]]) !!}

        @include('blog::admin.categories.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection