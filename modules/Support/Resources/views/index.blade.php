@extends('app')

@section('title')
    @lang('support::support.title.index')
@stop

@section('headline')
    <h1 class="text-uppercase">@lang('support::support.title.index')</h1>
    <h2>@lang('support::support.title.teaser')</h2>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @foreach($categories as $category)
                <article class="clearfix">
                    <div class="post-date">
                        <span><a href="{{ route('support.category.show', $category->slug) }}">@choice('support::support.articles.count', $category->articles->count())</a></span>
                    </div>
                    <h2>
                        <a href="{{ route('support.category.show', $category->slug) }}">{{ $category->content->name }}</a>
                    </h2>
                    <p>
                        {!! $category->content->text !!} <a href="{{ route('support.category.show', $category->slug) }}">@lang('support::support.category.articles')</a>
                    </p>
                </article>
            @endforeach
            {{-- simple pagination --}}
            {!! $categories->render(new \Vain\Presenters\Pagination\SimpleFrontendPresenter($categories)) !!}
        </div>
    </div>

@stop