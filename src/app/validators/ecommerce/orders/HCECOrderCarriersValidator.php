<?php namespace interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECOrderCarriersValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'order_id'                  => 'required',
            'carrier_id'                => 'required',
            'weight'                    => 'numeric',
            'shipping_price'            => 'numeric',
            'shipping_price_before_tax' => 'numeric',
            'shipping_tax_amount'       => 'numeric',

        ];
    }
}