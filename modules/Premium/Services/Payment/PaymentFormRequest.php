<?php namespace Modules\Premium\Services\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class PaymentFormRequest extends FormRequest
{
    /**
     * validation that has to pass
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required|numeric',
            'currency' => 'alpha|size:3',
            'identifier' => 'regex:/^[a-f0-9]{32}$/i', // simple md5 check
        ];
    }

    /***
     * only if we have an authorized user
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * @return PaymentModel
     */
    public function getPaymentModel()
    {
        return (new PaymentModel($this->all()))
            ->withUser($this->user());
    }
}