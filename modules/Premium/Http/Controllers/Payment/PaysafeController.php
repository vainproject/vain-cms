<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Routing\Controller;

class PaysafeController extends Controller {

    public function index()
    {
        $amount = 1.00;
        $mtid = md5( uniqid( time() ) );
        $success_url = '';
        $cancel_url = '';
        $notify_url = '';
        $locale = app()->getLocale();
        $currency = 'EUR';

        return view('premium::payment.paysafe.index', compact('amount', 'mtid', 'locale', 'currency', 'success_url', 'cancel_url', 'notify_url'));
    }

}