<?php namespace Modules\Premium\Services\Payment;

interface PaymentProvider {

    /**
     * @return mixed
     */
    function checkout();

    /**
     * @return mixed
     */
    function confirm();

    /**
     * @return mixed
     */
    function charge();

}