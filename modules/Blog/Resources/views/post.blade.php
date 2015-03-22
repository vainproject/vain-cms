@extends('app')

@section('content')

    <div class="container">
        <h1>{{ $post->content->title }}</h1>

        <p>
            {{ $post->content->text }}
        </p>
    </div>

@stop

