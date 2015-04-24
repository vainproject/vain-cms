<?php namespace Modules\Chartrans\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Modules\Chartrans\Entities\Request as ChartransRequest;

class StepTwoFormRequest extends FormRequest
{

    private $allowedStates = [
        ChartransRequest::STATE_STEP_TWO,
        ChartransRequest::STATE_STEP_THREE,
        ChartransRequest::STATE_STEP_FOUR,
        ChartransRequest::STATE_STEP_FIVE,
        ChartransRequest::STATE_DECLINED
    ];

    /**
     * validation that has to pass
     *
     * @return array
     */
    public function rules()
    {
        $expansionKeys = array_keys(config('chartrans.expansions'));
        $minExpansion = reset($expansionKeys);
        $maxExpansion = last($expansionKeys);

        return [
            'source_server_expansion' => 'required_if:source_server_type,private|between:'.$minExpansion.','.$maxExpansion,
            'source_server_type' => 'required',
            'source_server_website' => 'required_if:source_server_type,private',
            'source_server_realm' => 'required',
            'source_account_name' => 'required',
            'source_character_name' => 'required',
            'source_server_account_charaters' => 'required_if:source_server_type,private|max:10'
        ];
    }

    /***
     * @return bool
     */
    public function authorize()
    {
        // is the user allowed to change the data of this current step
        if ($request = $this->user()->chartrans) {
            if (!in_array($request->state, $this->allowedStates))
                return false;
        }

        return Auth::check();
    }
}