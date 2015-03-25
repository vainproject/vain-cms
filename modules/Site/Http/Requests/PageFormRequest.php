<?php namespace Modules\Site\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'slug',
            'role',
            'published_at',
            'concealed_at',
        ];
    }

    /**
     * todo implement permissions?
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }
}