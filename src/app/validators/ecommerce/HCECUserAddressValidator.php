<?php

namespace interactivesolutions\honeycombecommerceorders\app\validators\ecommerce;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

/**
 * Class HCECUserAddressValidator
 * @package interactivesolutions\honeycombecommerceorders\app\validators\ecommerce
 */
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
            'first_name' => 'required|min:1',
            'last_name' => 'required|min:1',
            'email' => 'nullable|email',
            'country_id' => 'nullable|exists:hc_regions_countries,id',
            'street_address' => 'required|min:1',
            'city' => 'required|min:1',
            'postal_code' => 'required|min:1',
            'phone' => 'required|min:1',
        ];
    }
}
