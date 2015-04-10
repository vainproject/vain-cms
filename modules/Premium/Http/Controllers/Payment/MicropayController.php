<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Premium\Services\Payment\PaymentProvider as ProviderContract;
use Symfony\Component\HttpKernel\Exception\HttpException;

class MicropayController extends Controller implements ProviderContract {

    function __construct()
    {
        $this->beforeFilter(function() {
            if ( ! config('payment.providers.micropayment.enabled'))
                throw new HttpException(503);
        });
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