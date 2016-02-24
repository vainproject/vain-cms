@extends('gallery::admin.index')

@section('title')
    @lang('gallery::admin.category.title.edit')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('gallery::admin.category.title.edit')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::model($category, [
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-message' => trans('gallery::admin.category.save.success'),
            'data-remote-error-message' => trans('gallery::admin.category.save.error'),
            'method' => 'PUT',
            'route' => ['gallery.admin.category.update', $category->id]]) !!}

        @include('gallery::admin.category.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection