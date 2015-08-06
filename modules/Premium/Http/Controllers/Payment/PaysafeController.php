<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Premium\Services\Payment\PaymentModel;
use Modules\Premium\Services\Payment\Paypal\CheckoutFormRequest;

class PaysafeController extends Controller {

    function __construct()
    {
        $this->middleware('payment.provider.enabled:paysafe');
    }

    public function index(CheckoutFormRequest $request)
    {
        $payment = (new PaymentModel($request->all()))
            ->withUser($request->user());

        return view('premium::payment.paysafe.index', compact('payment'));
    }

    /**
     * indicates that the payment finished with success
     *
     * @return Response
     */
    function success()
    {
        return view('premium::payment.paysafe.success');
    }

    /**
     * indicates that the payment failed
     *
     * @return Response
     */
    function error()
    {
        return view('premium::payment.paysafe.error');
    }

    /**
     * callback used by the provider to verify the payment
     *
     * @return Response
     */
    function callback()
    {
        return response();
    }
}