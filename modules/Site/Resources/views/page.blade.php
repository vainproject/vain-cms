@extends('app')

@section('title')
    @lang('site::page.title.show', ['title' => $page->content->title])
@stop

@section('keywords')
    {{ $page->content->keywords }}
@stop

@section('description')
    {{ $page->content->description }}
@stop

@section('content')
    <div class="container">
        @can('site.pages.edit'))
            <a href="{{ route('site.admin.sites.edit', ['id' => $page->id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
        @endcan

        <h1>{{ $page->content->title }}</h1>
        {!! $page->content->text !!}
    </div>
@stop