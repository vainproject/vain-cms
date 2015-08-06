<?php namespace Modules\Premium\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Used for Paypal approval backlinks
 *
 * Class ApprovalFormRequest
 * @package Modules\Premium\Http\Requests
 */
class ApprovalFormRequest extends FormRequest
{
    /**
     * @return string
     */
    public function getPayerId()
    {
        return $this->input('PayerID');
    }

    /**
     * @return string
     */
    public function getPaymentId()
    {
        return $this->input('paymentId');
    }

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
}