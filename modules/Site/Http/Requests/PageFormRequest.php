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
//        $attrs = [
//            'locale',
//            'title',
//            'keywords',
//            'description',
//            'text'
//        ];
//
//        $rules = [];
//
//        foreach (['en', 'de'] as $locale)
//        {
//            foreach ($attrs as $attr)
//            {
//                array_push( $rules, sprintf('%s_%s', $locale, $attr));
//            }
//        }

        return [
            'slug' => 'required',
            'user_id' => 'exists:users,id',
            'role' => 'exists:roles,name',
            'published_at' => 'date',
            'concealed_at' => 'date',
        ];
    }

    /**
     * todo implement permissions?
     *
     * @return bool
     */
    public function authorize()
    {
        $route = $this->route()->getName();

        if (in_array($route, ['site.admin.sites.create', 'site.admin.sites.store']))
        {

        }
        else if (in_array($route, ['site.admin.sites.edit', 'site.admin.sites.update']))
        {

        }

        return Auth::check();
    }

    protected function failedAuthorization()
    {
        parent::failedAuthorization();
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