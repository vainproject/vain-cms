<?php namespace Modules\Premium\Services\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class PaymentFormRequest extends FormRequest
{
    public function all()
    {
        // attach user object to Request::all()
        return array_replace_recursive(parent::all(), [ 'user' => $this->user() ]);
    }

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
            'transaction' => 'regex:/^[a-f0-9]{32}$/i', // simple md5 check
        ];
    }

    /***
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->ajax()) {
            $this->session()->flashInput($this->all());
            $this->session()->flash('errors', $validator->getMessageBag());
        }

        parent::failedValidation($validator);
    }
}