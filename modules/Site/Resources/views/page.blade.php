@extends('app')

@section('title')
    @lang('site::page.title', ['title' => $page->title])
@stop

@section('keywords')
    {{ $page->keywords }}
@stop

@section('description')
    {{ $page->description }}
@stop

@section('keywords')
    {{ $page->title }}
@stop

@section('content')
    <div class="container">
        <h1>{{ $page->title }}</h1>
        {!! $page->text !!}
    </div>
@stop