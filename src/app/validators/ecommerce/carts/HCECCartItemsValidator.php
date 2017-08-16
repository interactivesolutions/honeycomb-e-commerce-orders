<?php namespace interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\carts;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECCartItemsValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'cart_id' => 'required',
'goods_id' => 'required',
'combination_id' => 'required',
'amount' => 'required',

        ];
    }
}