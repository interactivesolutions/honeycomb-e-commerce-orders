<?php namespace interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECOrderStatesTranslationsValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'translations.*.label' => 'required',

        ];
    }
}