@extends('app')

@section('title')
    @lang('premium::payment.bitcoin.title')
@stop

@section('content')
    <div class="container">
        <h3>@lang('premium::payment.bitcoin.title')</h3>
        <p>@lang('premium::payment.bitcoin.note')</p>

        <hr />

        <p>@lang('premium::payment.bitcoin.pay.address')</p>
        <p class="lead">{{ config('payment.providers.bitcoin.address') }}</p>
        <p>@lang('premium::payment.bitcoin.pay.code')</p>
        <p><img src="{{ config('payment.providers.bitcoin.code_url') }}"></p>

        <hr />

        <p>Danach bitte eine Email mit dem Hash oder Datum/Uhrzeit + Wert der Transaktion an <a href="mailto:{{ config('payment.contact.mail') }}">{{ config('payment.contact.mail') }}</a> senden.<br>
            Die Email muss auch eure Benutzer ID enthalten (<strong>Deine Benutzer ID ist {{ $user->id }}</strong>).</p>
            Dann wird das Guthaben entsprechend des zum Zeitpunkt der Überweisung gültigen Kurses gutgeschrieben. (Ausschlaggebend ist mtgox.com close eurokurs zur vollen Stunde.)
        <p>Es kann etwa 1 Tag dauern bis das Guthaben gutgeschrieben wurde.</p>

        <blockquote>
            <b>Beispiel:</b>
            <br>Überweisung am 05.11.13 um 18.10 von 0.1BC
            <br>Kurs MTGOX am 05.11.13 um 15:00 Uhr (-4h Zeitversch.) 186,365.
            <br>Gutschrift: 18,64 Euro.
        </blockquote>

        <p>@lang('premium::payment.bitcoin.support.introduction', [ 'url' => link_to( 'http://mybitcoin.de/bitcoin-einfuehrung', trans('premium::payment.bitcoin.here') ) ])</p>
        <p>@lang('premium::payment.bitcoin.support.wallet', [ 'url' => link_to( 'https://blockchain.info/de/wallet', trans('premium::payment.bitcoin.here') ) ])</p>
    </div>
@stop