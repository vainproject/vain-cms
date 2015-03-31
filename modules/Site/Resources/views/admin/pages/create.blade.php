@extends('site::admin.index')

@section('title')
    @lang('site::admin.title.create')
@stop

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>@lang('site::admin.title.create')</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        {!! Form::open([
            'class' => 'form-horizontal',
            'data-remote',
            'data-remote-success-redirect' => route('site.admin.sites.index'),
            'data-remote-error-message' => trans('site::admin.save.error'),
            'route' => 'site.admin.sites.store']) !!}

        @include('site::admin.pages.form')

        {!! Form::close() !!}
    </section><!-- /.content -->
@endsection