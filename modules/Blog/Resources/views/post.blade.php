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

        <h3>{{ Lang::choice('blog::blog.comment_count', $post->comments->count()) }}</h3>
        @foreach($post->comments as $comment)

            <div class="panel panel-default">
                <div class="panel-body">
                    {{ $comment->text }}
                </div>
                <div class="panel-footer">
                    {{ trans('blog::blog.comment_credits', ['name' => $comment->user->name, 'time' => $comment->created_at->diffForHumans()]) }}
                </div>
            </div>


        @endforeach
    </div>

@stop

