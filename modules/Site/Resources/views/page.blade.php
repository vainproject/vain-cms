@extends('app')

@section('title')
    @lang('site::page.title', ['title' => $page->content->title])
@stop

@section('keywords')
    {{ $page->content->keywords }}
@stop

@section('description')
    {{ $page->content->description }}
@stop

@section('keywords')
    {{ $page->content->title }}
@stop

@section('content')
    <div class="container">
        @if (Auth::user()->can('site.pages.edit'))
            <a href="{{ route('site.admin.sites.edit', ['id' => $page->id]) }}"><i class="glyphicon glyphicon-edit"></i></a>
        @endif

        <h1>{{ $page->content->title }}</h1>
        {!! $page->content->text !!}
    </div>
@stop