<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class MicropayController extends Controller {

    function __construct()
    {
        $this->middleware('payment.provider.enabled:micropayment');
    }

    public function index()
    {
        return view('premium::payment.micropay.index');
    }

    /**
     * indicates that the payment finished with success
     *
     * @return Response
     */
    public function success()
    {
        return view('premium::payment.micropay.success');
    }

    /**
     * indicates that the payment failed
     *
     * @return Response
     */
    public function error()
    {
        return view('premium::payment.micropay.error');
    }

    /**
     * callback used by the provider to verify the payment
     *
     * @return Response
     */
    public function callback()
    {
        return response();
    }
}