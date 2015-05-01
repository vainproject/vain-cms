@extends('app')

@section('title')
    @lang('premium::payment.paysafe.title')
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

        <h3>@lang('premium::payment.paysafe.title')</h3>

        <p class="lead">{{ $payment->amount }} &euro;</p>

        {!! Form::open(['url' => config('payment.providers.paysafe.endpoint')]) !!}
            {!! Form::hidden('amount', $payment->amount) !!}
            {!! Form::hidden('mtid', $payment->transaction) !!}
            {!! Form::hidden('currency', $payment->currency) !!}
            {!! Form::hidden('language', $payment->user->locale) !!}
            {!! Form::hidden('success_link', route('premium.payment.paysafe.success')) !!}
            {!! Form::hidden('abort_link', route('premium.payment.paysafe.error')) !!}
            {!! Form::hidden('notification_link', route('premium.payment.paysafe.callback')) !!}

            <button class="btn btn-default" type="submit">@lang('premium::premium.action.pay')</button>
        {!! Form::close() !!}
    </div>
@stop