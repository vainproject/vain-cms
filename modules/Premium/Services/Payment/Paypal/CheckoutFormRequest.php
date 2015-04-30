<?php namespace Modules\Premium\Services\Payment\Paypal;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Modules\Premium\Services\Payment\PaymentFormRequest;

class CheckoutFormRequest extends PaymentFormRequest
{
    /**
     * @return PaypalModel
     */
    public function getPaymentModel()
    {
        return (new PaypalModel($this->all()))
            ->withUser($this->user());
    }
}