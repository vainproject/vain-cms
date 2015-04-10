@extends('app')

@section('title')
    Payment
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

        <h3>Payment</h3>
        @if(config('payment.providers.paypal.enabled'))
        <p>
            {!! link_to_route('premium.payment.paypal.index', 'PayPal', ['amount' => 5.00]) !!}
        </p>
        @endif
        @if(config('payment.providers.paysafe.enabled'))
        <p>
            {!! link_to_route('premium.payment.paysafe.index', 'PaySafe Card', ['amount' => 5.00]) !!}
        </p>
        @endif
        @if(config('payment.providers.micropayment.enabled'))
        <p>
            {!! link_to_route('premium.payment.micropay.index', 'Micropayment Call2Pay', ['amount' => 5.00]) !!}
        </p>
        @endif
        @if(config('payment.providers.bitcoin.enabled'))
        <p>
            {!! link_to_route('premium.payment.bitcoin.index', 'Bitcoin') !!}
        </p>
        @endif
        @if(config('payment.providers.giropay.enabled'))
        <p>
            {!! link_to_route('premium.payment.giropay.index', 'ELV') !!}
        </p>
        @endif
    </div>
@stop