@extends('app')

@section('title')
    @lang('premium::payment.giropay.title')
@stop

@section('content')
    <div class="container">
        <h3>@lang('premium::payment.giropay.title')</h3>
        <p>@lang('premium::payment.giropay.note')</p>

        <h4>@lang('premium::payment.giropay.address')</h4>
        <table class="table">
            <tr>
                <td>@lang('premium::payment.giropay.account.holder'):</td>
                <td>{{ config('payment.providers.giropay.account.holder') }}</td>
            </tr>
            <tr>
                <td>@lang('premium::payment.giropay.bank.name'):</td>
                <td>{{ config('payment.providers.giropay.bank.name') }}</td>
            </tr>
            <tr>
                <td>@lang('premium::payment.giropay.account.iban')</td>
                <td>{{ config('payment.providers.giropay.account.iban') }}</td>
            </tr>
            <tr>
                <td>@lang('premium::payment.giropay.bank.bic')</td>
                <td>{{ config('payment.providers.giropay.bank.bic') }}</td>
            </tr>
            <tr>
                <td><b>@lang('premium::payment.giropay.purpose'):</b></td>
                <td><b>{{ str_replace([ ':user_id' ], [ $user->id ], config('payment.providers.giropay.purpose')) }}</b></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>@lang('premium::payment.giropay.bank.code'):</td>
                <td>{{ config('payment.providers.giropay.bank.code') }}</td>
            </tr>
            <tr>
                <td>@lang('premium::payment.giropay.account.number'):</td>
                <td>{{ config('payment.providers.giropay.account.number') }}</td>
            </tr>
        </table>
    </div>
@stop