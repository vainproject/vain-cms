<?php namespace Modules\Premium\Http\Controllers\Payment;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Premium\Services\Payment\PaymentProvider as ProviderContract;

class MicropayController extends Controller implements ProviderContract {

    function __construct()
    {
        $this->beforeFilter(function() {
            if ( ! config('payment.providers.micropay.enabled'))
                throw new HttpException(503);
        });
    }

    public function index()
    {
        return view('premium::index');
    }

    /**
     * indicates that the payment finished with success
     *
     * @return Response
     */
    public function success()
    {
        // TODO: Implement success() method.
    }

    /**
     * indicates that the payment failed
     *
     * @return Response
     */
    public function error()
    {
        // TODO: Implement error() method.
    }

    /**
     * callback used by the provider to verify the payment
     *
     * @return Response
     */
    public function callback()
    {
        // TODO: Implement callback() method.
    }
}