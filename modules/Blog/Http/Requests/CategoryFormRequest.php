<?php namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class CategoryFormRequest extends FormRequest
{
    /**
     * validation that has to pass
     *
     * @return array
     */
    public function rules()
    {
        $attributes = [
            'name' => 'required'
        ];

        $rules = $this->buildLocalizedRules($attributes);

        return array_merge($rules, [
            'id' => 'exists:post_categories,id',
            'slug' => 'required|alpha_dash|unique:post_categories,slug,'.$this->route('categories')
        ]);
    }

    private function buildLocalizedRules($attributes)
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