@extends('app')

@section('title')
    @lang('message::message.title.list')
@stop

@section('styles')
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-9">
                {!! Form::open(['route' => 'message.message.store']) !!}
                    {!! Form::label('subject', trans('message::message.subject')) !!}
                    {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                    <br/>

                    {!! Form::label('participants', trans('message::message.participants')) !!}
                    {!! Form::text('participants', null, ['class' => 'form-control']) !!}
                    <br/>

                    {!! Form::label('message', trans('message::message.message')) !!}
                    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                    <br/>

                    {!! Form::submit(trans('message::message.send'), ['class' => 'form-control']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
