<?php namespace Modules\Site\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class PageFormRequest extends FormRequest
{
    /**
     * validation that has to pass
     *
     * @return array
     */
    public function rules()
    {
        $attributes = [
            'title' => 'required',
            'text' => 'required'
        ];

        $rules = $this->buildRules($attributes);

        return array_merge($rules, [
            'slug' => 'required',
            'user_id' => 'exists:users,id',
            'role' => 'exists:roles,name',
            'published_at' => 'date',
            'concealed_at' => 'date',
        ]);
    }

    /**
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * builds localized suffixed rules for validation
     *
     * @param $attributes
     * @return array
     */
    protected function buildRules($attributes)
    {
        $rules = [];
        $locales = config('app.locales');

        foreach ($locales as $locale => $name)
        {
            foreach ($attributes as $attribute => $rule)
            {
                $rules[$attribute .'_'. $locale] = $rule;
            }
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->ajax())
        {
            $this->session()->flash('errors', $validator->getMessageBag());
        }

        parent::failedValidation($validator);
    }
}