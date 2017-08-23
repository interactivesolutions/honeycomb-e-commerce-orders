<?php namespace interactivesolutions\honeycombecommerceorders\app\validators\ecommerce;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECUserAddressValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'form_name'      => 'required|min:3',
            'first_name'     => 'required|min:3',
            'last_name'      => 'required|min:3',
            'email'          => 'required|email',
            'country_id'     => 'required|exists:oc_countries,id',
            'street_address' => 'required|min:3',
            'city'           => 'required|min:3',
            'postal_code'    => 'required|numeric|min:5',
            'phone'          => 'required|min:9',
        ];
    }
}