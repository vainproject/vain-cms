@extends('app')

@section('content')

    <div class="container">

        @foreach($posts as $post)

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <a href="{{ route('blog.post.show', $post->slug) }}">{{ $post->content->title }}</a>
                        <span class="label label-default">{{ $post->category->content->name }}</span>
                        <span class="badge pull-right">{{ $post->comments->count() }}</span>
                    </h3>
                </div>
                <div class="panel-body">
                    {{ $post->content->text }}
                </div>
            </div>

        @endforeach
    </div>

@stop