@extends('app')

@section('title')
    @lang('blog::blog.title.post', ['name' => $post->content->title])
@stop

@section('keywords')
    {{ $post->content->keywords }}
@stop

@section('description')
    {{ $post->content->description }}
@stop

@section('headline')
    <h1 class="text-uppercase">{{ $post->content->title }}</h1>
    <h2>{{ $post->content->description }}</h2>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            {{-- Post section --}}
            <div class="post-date">
                {{ $post->created_at->formatLocalized('%d. %B, %Y') }} |
                {!! link_to_route('user.profile', $post->user->name, ['id' => $post->user->id]) !!}
                <span><a href="{{ route('blog.post.show', $post->slug) }}">@choice('blog::blog.comment.count', $post->comments->count())</a></span>
            </div>

            <div class="post-intro">
                {!! $post->content->teaser !!}
            </div>

            <p>{!! $post->content->body !!}</p>

            @if ($post->content->keywords)
                <div class="post-date">
                    tags | {{ $post->content->keywords }}
                </div>
            @endif

            {{-- Author section --}}
            <div id="author" class="clearfix">
                <img class="img-circle" alt="" src="{{ $post->user->avatar }}" height="96" width="96">
                <div class="author-info">
                    <h3>{{ $post->user->name }}</h3>
                    <p>{{ $post->user->about }}</p>
                </div>
            </div>
            <div class="clearfix"></div>

            {{-- Comment section --}}
            @can('blog.comment.show')
                <h3>@choice('blog::blog.comment.count', $post->comments->count())</h3>
                <div class="media">
                    <hr />

                    @foreach($post->comments as $comment)
                        <a class="pull-left avatar" href="#">
                            <img class="media-object img-circle" src="{{ $comment->user->avatar }}" width="40" height="40" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">
                                {!! link_to_route('user.profile', $comment->user->name, ['id' => $comment->user->id]) !!}
                                <span>
                                    {{ $comment->created_at->diffForHumans() }}
                                    @can('destroy', $comment)
                                        {!! Form::open([
                                            'class' => 'form-inline pull-right',
                                            'data-remote',
                                            'data-remote-success-message' => trans('blog::blog.comment.delete.success'),
                                            'data-remote-error-message' => trans('blog::blog.comment.delete.error'),
                                            'route' => ['blog.comment.destroy', $comment->id],
                                            'method' => 'DELETE'])
                                        !!}
                                        | <a class="text-uppercase" href="#" data-submit>@lang('blog::blog.comment.delete.button')</a>
                                    {!! Form::close() !!}
                                    @endcan
                                </span>
                            </h4>
                            <p>{{ $comment->text }}</p>
                        </div>
                    @endforeach
                </div>

                {{--<div id="comments_pagination">--}}
                    {{--<span class="page-numbers current">1</span>--}}
                    {{--<a class="page-numbers" href="#">2</a>--}}
                    {{--<a class="next page-numbers" href="#"><i class="icon-arrow-right2"></i></a>--}}
                {{--</div>--}}
            @endcan

            @can('blog.comment.show')
                <h3>@lang('blog::blog.comment.write')</h3>

                {!! Form::open([
                    'data-remote',
                    'data-remote-success-message' => trans('blog::blog.comment.save.success'),
                    'data-remote-error-message' => trans('blog::blog.comment.save.error'),
                    'url' => route('blog.comment.store', ['postId' => $post->id])]) !!}

                    <div class="wow fadeInUp">
                        <div class="form-group">
                        <textarea name="text" class="form-control" data-expand data-expand-rows-max="6" rows="2"
                                  placeholder="{{ Lang::get('blog::blog.comment.placeholder')}}"></textarea>
                        </div>
                        <div class="form-group">
                            {!! Form::submit(Lang::get('blog::blog.comment.save.button'),
                                ['class' => 'btn btn-info pull-right']) !!}
                        </div>
                    </div>
                    <div class="clearfix"></div>
                {!! Form::close() !!}
            @endcan
        </div>
    </div>
@stop

