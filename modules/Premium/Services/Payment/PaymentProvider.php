<?php namespace Modules\Premium\Services\Payment;

use Illuminate\Http\Response;

interface PaymentProvider {

    /**
     * indicates that the payment finished with success
     *
     * @return Response
     */
    public function success();

    /**
     * indicates that the payment failed
     *
     * @return Response
     */
    public function error();

    /**
     * callback used by the provider to verify the payment
     *
     * @return Response
     */
    public function callback();

}