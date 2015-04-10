<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Premium\Services\Payment\PaymentFormRequest;
use Modules\Premium\Services\Payment\PaymentModel;
use Modules\Premium\Services\Payment\PaymentProvider as ProviderContract;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PaysafeController extends Controller implements ProviderContract {

    function __construct()
    {
        $this->beforeFilter(function() {
            if ( ! config('payment.providers.paysafe.enabled'))
                throw new HttpException(503);
        });
    }

    public function index(PaymentFormRequest $request)
    {
        $payment = new PaymentModel($request->all());

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