<?php namespace interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECOrderDiscountCodesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'order_id'          => 'required',
            'code'              => 'required',
            'type'              => 'required',
            'shipping_included' => 'required',
            'free_shipping'     => 'required',
        ];
    }
}