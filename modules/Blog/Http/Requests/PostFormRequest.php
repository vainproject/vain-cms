<?php namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;

class PostFormRequest extends FormRequest
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

        $rules = $this->buildLocalizedRules($attributes);

        return array_merge($rules, [
            'id' => 'exists:posts,id',
            'slug' => 'required|unique:posts,slug,'.$this->route('posts'),
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:post_categories,id'
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
            $this->session()->flash('errors', $validator->getMessageBag());
        }

        parent::failedValidation($validator);
    }
}