@extends('admin')

@section('title')
    @lang('premium::premium.title.index')
@stop

@section('content')

    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('premium.name') !!}
    </p>

@stop