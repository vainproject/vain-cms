@extends('app')

@section('title')
    @lang('premium::payment.paysafe.title')
@stop

@section('content')
    <div class="container">
        <h3>@lang('premium::payment.paysafe.title')</h3>

        <p class="lead">{{ $amount }} &euro;</p>

        <form method="post" action="https://cashpay.cashrun.com/risinggods/psc/psc_start.php">
            <input type="hidden" readonly="true" id="paysafe_amt" value="{{ $amount }}" name="amount">
            <input type="hidden" name="mtid" value="{{ $mtid }}">
            <input type="hidden" name="currency" value="EUR" >
            <input type="hidden" name="language" value="de">
            <input type="hidden" name="success_link" value="{{ $success_url }}">
            <input type="hidden" name="abort_link" value="{{ $cancel_url }}">
            <input type="hidden" name="notification_link" value="{{ $notify_url }}">
        </form>

        <button class="btn btn-default" type="submit">@lang('premium::payment.action.submit')</button>
    </div>
@stop