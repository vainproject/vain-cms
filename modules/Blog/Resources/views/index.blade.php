@extends('app')

@section('title')
    @lang('blog::blog.title.index')
@stop

@section('headline')
    <h1 class="text-uppercase">@lang('blog::blog.title.index')</h1>
    <h2>@lang('blog::blog.title.teaser')</h2>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @foreach($posts as $post)
                <article class="clearfix">
                    <div class="post-date">
                        {{ $post->created_at->formatLocalized('%d. %B, %Y') }} |
                        {!! link_to_route('user.profile', $post->user->name, ['id' => $post->user->id]) !!}
                        <span><a href="{{ route('blog.post.show', $post->slug) }}">@choice('blog::blog.comment.count', $post->comments->count())</a></span>
                    </div>
                    <h2>
                        <a href="{{ route('blog.post.show', $post->slug) }}">{{ $post->content->title }}</a>
                    </h2>
                    <p>
                        {!! $post->content->teaser !!} <a href="{{ route('blog.post.show', $post->slug) }}">@lang('blog::blog.post.more')</a>
                    </p>
                </article>
            @endforeach
            {{-- simple pagination --}}
            {!! $posts->render(new \Vain\Presenters\Pagination\SimpleFrontendPresenter($posts)) !!}
        </div>
    </div>

@stop