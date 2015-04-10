@extends('app')

@section('title')
    @lang('premium::payment.micropay.title')
@stop

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3>@lang('premium::payment.micropay.title')</h3>

        <h1>Index</h1>
    </div>
@stop