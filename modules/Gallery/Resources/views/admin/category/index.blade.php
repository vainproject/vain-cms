@extends('gallery::admin.index')

@section('title')
    @lang('gallery::admin.category.title.index')
@stop

@section('content')

    <section class="content-header">
        <h1>
            @lang('gallery::admin.title.category')
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a class="btn btn btn-primary" href="{{ route('gallery.admin.category.create') }}">
                    <i class="fa fa-plus-circle"></i> @lang('gallery::admin.category.action.create')
                </a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>@lang('gallery::admin.category.field.id')</td>
                        <td>@lang('gallery::admin.category.field.slug')</td>
                        <td>@lang('gallery::admin.category.field.name')</td>
                        <td>@lang('gallery::admin.category.field.photos_count')</td>
                        <td>@lang('gallery::admin.category.field.created_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->content->name }}</td>
                            <td>{{ $category->photos->count() }}</td>
                            <td>{{ $category->created_at ? $category->created_at->diffForHumans() : '-' }}</td>
                            <td class="text-right">
                                {!! Form::open([
                                    'class' => 'form-inline',
                                    'data-remote',
                                    'data-remote-success-message' => trans('gallery::admin.category.delete.success'),
                                    'data-remote-error-message' => trans('gallery::admin.category.delete.error'),
                                    'route' => ['gallery.admin.category.destroy', $category->id],
                                    'method' => 'DELETE'])
                                !!}
                                <a class="btn btn-sm btn-default" href="{{ route('gallery.admin.category.edit', $category->id) }}"><i class="fa fa-edit"></i> @lang('gallery::admin.category.action.edit')</a>
                                <button class="btn btn-sm btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i> @lang('gallery::admin.category.action.destroy')</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('gallery::admin.partials.pagination', [ 'items' => $categories ])
        </div>
    </section>
    @include('gallery::admin.category.modal')
@stop