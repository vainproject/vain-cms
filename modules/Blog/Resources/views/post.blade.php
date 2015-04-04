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

        @if(Entrust::can('blog.comment.show'))
            <h3>{{ Lang::get('blog::blog.comment.write') }}</h3>

            {!! Form::open([
                'data-remote',
                'data-remote-success-message' => trans('blog::blog.comment.save.success'),
                'data-remote-error-message' => trans('blog::blog.comment.save.error'),
                'url' => route('blog.comment.create', ['postId' => $post->id])]) !!}

                <div class="form-group">
                    <textarea name="text" class="form-control" data-expand data-expand-rows-max="6" rows="2"
                              placeholder="{{ Lang::get('blog::blog.comment.placeholder')}}"></textarea>
                </div>
                <div class="form-group">
                    {!! Form::submit(Lang::get('blog::blog.comment.save.button'),
                        ['class' => 'btn btn-info pull-right']) !!}
                </div>
                <div class="clearfix"></div>
            {!! Form::close() !!}
        @endif

        @if(Entrust::can('blog.comment.create'))
            <h3>{{ Lang::choice('blog::blog.comment.count', $post->comments->count()) }}</h3>
            @foreach($post->comments as $comment)
                <div class="panel @if($comment->bluepost) panel-info-styled-footer @else panel-default @endif">
                    <div class="panel-body">
                        {{ $comment->text }}
                    </div>
                    <div class="panel-footer">
                        <div class="pull-right">
                            @if(Entrust::can('blog.comment.destroy'))
                                {!! Form::open([
                                    'class' => 'form-inline',
                                    'data-remote',
                                    'data-remote-success-message' => trans('blog::blog.comment.delete.success'),
                                    'data-remote-error-message' => trans('blog::blog.comment.delete.error'),
                                    'route' => ['blog.comment.destroy', $comment->id],
                                    'method' => 'DELETE'])
                                !!}
                                <button class="btn btn-xs btn-danger" type="submit"><i class="fa fa-remove"></i></button>
                                {!! Form::close() !!}
                            @endif
                        </div>
                        {{ trans('blog::blog.comment.credits', ['time' => $comment->created_at->diffForHumans()]) }} @userbadge($comment->user)
                    </div>
                </div>
            @endforeach
        @endif
    </div>

@stop

