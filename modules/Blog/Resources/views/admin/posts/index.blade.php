@extends('blog::admin.index')

@section('title')
    @lang('blog::blog.title.index')
@stop

@section('content')

    <section class="content-header">
        <h1>
            @lang('blog::admin.title.posts')
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a class="btn btn btn-primary" href="{{ route('blog.admin.posts.create') }}">
                    <i class="fa fa-plus-circle"></i> @lang('blog::admin.posts.action.create')
                </a>
            </div>
            <div class="box-body table-responsive no-padding">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>@lang('blog::admin.posts.field.id')</td>
                        <td>@lang('blog::admin.posts.field.slug')</td>
                        <td>@lang('blog::admin.posts.field.author')</td>
                        <td>@lang('blog::admin.posts.field.created_at')</td>
                        <td>@lang('blog::admin.posts.field.published_at')</td>
                        <td>@lang('blog::admin.posts.field.concealed_at')</td>
                        <td></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->slug }} <a href="{{ route('blog.post.show', ['slug' => $post->slug]) }}" target="_blank"><i class="fa fa-external-link"></i></a></td>
                            <td>@userbadge($post->user)</td>
                            <td>{{ $post->created_at ? $post->created_at->diffForHumans() : '-' }}</td>
                            <td>{{ $post->published_at ? $post->published_at->diffForHumans() : '-' }}</td>
                            <td>{{ $post->concealed_at ? $post->concealed_at->diffForHumans() : '-' }}</td>
                            <td class="text-right">
                                {!! Form::open([
                                    'class' => 'form-inline',
                                    'data-remote',
                                    'data-remote-success-message' => trans('blog::admin.posts.delete.success'),
                                    'data-remote-error-message' => trans('blog::admin.posts.delete.error'),
                                    'route' => ['blog.admin.posts.destroy', $post->id],
                                    'method' => 'DELETE'])
                                !!}
                                <a class="btn btn-sm btn-default" href="{{ route('blog.admin.posts.edit', $post->id) }}"><i class="fa fa-edit"></i> @lang('blog::admin.posts.action.edit')</a>
                                <button class="btn btn-sm btn-danger" type="submit" data-confirm="#modal"><i class="fa fa-trash"></i> @lang('blog::admin.posts.action.destroy')</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('blog::admin.partials.pagination', [ 'items' => $posts ])
        </div>
    </section>
    @include('blog::admin.posts.modal')
@stop