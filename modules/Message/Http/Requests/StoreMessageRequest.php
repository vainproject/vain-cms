<?php namespace Modules\Message\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Vain\Http\Requests\Request;

class StoreMessageRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // ToDo: more specific validation rules
        return [
            'subject'      => 'required',
            'message'      => 'required',
            'participants' => 'required',
        ];
    }

}
