@extends('app')

@section('title')
	@lang('gallery::index.title')
@stop

@section('content')
	
	<h1>Hello World</h1>
	
	<p>
		This view is loaded from module: {!! config('gallery.name') !!}
	</p>

@stop