@extends('app')

@section('title')
    @lang('premium::payment.paypal.title')
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

        <h3>@lang('premium::payment.paypal.title')</h3>

            <p class="lead">{{ $payment->amount }} &euro;</p>

            {!! Form::open(['route' => 'premium.payment.paypal.checkout']) !!}
            {!! Form::hidden('amount', $payment->amount) !!}

            <button class="btn btn-default" type="submit">@lang('premium::premium.action.pay')</button>
            {!! Form::close() !!}
    </div>
@stop