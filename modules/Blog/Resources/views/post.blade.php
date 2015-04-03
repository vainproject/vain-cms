@extends('app')

@section('title')
    @lang('blog::blog.title.post', ['name' => $post->content->title])
@stop

@section('content')

    <div class="container">
        <h1>
            {{ $post->content->title }}
        </h1>
        <span class="label label-default">{{ $post->category->content->name }}</span>

        <p>
            {{ $post->content->text }}
        </p>

        <hr>

        <h3>{{ Lang::get('blog::blog.comment.write') }}</h3>

        {!! Form::open([
            'data-remote',
            'data-remote-success-redirect' => route('blog.post.show', ['slug' => $post->slug]),
            'data-remote-error-message' => trans('blog::blog.comment.save.error'),
            'url' => route('blog.comment.create', ['postId' => $post->id])]) !!}

            <div class="form-group">
                <textarea name="text" class="form-control" data-expand data-expand-rows-max="6" rows="2" placeholder="{{ Lang::get('blog::blog.comment.placeholder')}}"></textarea>
            </div>
            <div class="form-group">
                {!! Form::submit(Lang::get('blog::blog.comment.save.button'),
                    ['class' => 'btn btn-info pull-right']) !!}
            </div>
            <div class="clearfix"></div>
        {!! Form::close() !!}

        <h3>{{ Lang::choice('blog::blog.comment.count', $post->comments->count()) }}</h3>
        @foreach($post->comments as $comment)

            <div class="panel panel-default">
                <div class="panel-body">
                    {{ $comment->text }}
                </div>
                <div class="panel-footer">
                    {{ trans('blog::blog.comment.credits', ['name' => $comment->user->name, 'time' => $comment->created_at->diffForHumans()]) }}
                </div>
            </div>

        @endforeach
    </div>

@stop

