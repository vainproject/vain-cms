@extends('blog::admin.index')

@section('title')
    @lang('blog::admin.categories.title.index')
@stop

@section('content')

    <section class="content-header">
        <h1>
            @lang('blog::admin.title.categories')
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a class="btn btn btn-primary" href="{{ route('blog.admin.categories.create') }}">
                    <i class="fa fa-plus-circle"></i> @lang('blog::admin.categories.action.create')
                </a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>@lang('blog::admin.categories.field.id')</td>
                        <td>@lang('blog::admin.categories.field.slug')</td>
                        <td>@lang('blog::admin.categories.field.created_at')</td>
                        <td>@lang('blog::admin.categories.field.post_count')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->slug }} <a href="{{ route('blog.category.show', ['slug' => $category->slug]) }}" target="_blank"><i class="fa fa-external-link"></i></a></td>
                            <td>{{ $category->created_at ? $category->created_at->diffForHumans() : '-' }}</td>
                            <td>{{ $category->posts->count() }}</td>
                            <td class="text-right">
                                {!! Form::open([
                                    'class' => 'form-inline',
                                    'data-remote',
                                    'data-remote-success-message' => trans('blog::admin.categories.delete.success'),
                                    'data-remote-error-message' => trans('blog::admin.categories.delete.error'),
                                    'route' => ['blog.admin.categories.destroy', $category->id],
                                    'method' => 'DELETE'])
                                !!}
                                <a class="btn btn-sm btn-default" href="{{ route('blog.admin.categories.edit', $category->id) }}"><i class="fa fa-edit"></i> @lang('blog::admin.categories.action.edit')</a>
                                <button class="btn btn-sm btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i> @lang('blog::admin.categories.action.destroy')</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('blog::admin.partials.pagination', [ 'items' => $categories ])
        </div>
    </section>
    @include('blog::admin.categories.modal')
@stop