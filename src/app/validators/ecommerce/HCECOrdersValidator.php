<?php namespace interactivesolutions\honeycombecommerceorders\app\validators\ecommerce;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECOrdersValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'total_price'                => 'numeric',
            'total_price_before_tax'     => 'numeric',
            'total_discounts'            => 'numeric',
            'total_discounts_before_tax' => 'numeric',
            'total_paid'                 => 'numeric',
            'total_paid_before_tax'      => 'numeric',
        ];
    }
}