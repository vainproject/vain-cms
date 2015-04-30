<?php namespace Modules\Premium\Services\Payment\Paypal;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class ApprovalFormRequest extends FormRequest
{
    /**
     * validation that has to pass
     *
     * @return array
     */
    public function rules()
    {
        return [
            'paymentId' => 'required',
            'PayerID' => 'required',
        ];
    }

    /***
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * @param $apiContext
     * @return Payment
     */
    public function getPayment($apiContext)
    {
        return Payment::get($this->input('paymentId'), $apiContext);
    }

    /**
     * @return PaymentExecution
     */
    public function getExecution()
    {
        $execution = new PaymentExecution();
        $execution->setPayerId($this->input('PayerID'));

        return $execution;
    }
}