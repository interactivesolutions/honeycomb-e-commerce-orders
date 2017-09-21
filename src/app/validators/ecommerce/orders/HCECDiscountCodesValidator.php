<?php namespace interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECDiscountCodesValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'code'            => 'required',
            'type'            => 'required|in:percentage,fixed,none',
            'free_shipping'   => 'required_if:type,none',
            'amount'          => 'required_if:type,percentage,fixed|numeric|min:0',
            'total_available' => 'required|integer',
            'minimum_amount'  => 'required|numeric',
            'valid_from'      => 'required|date',
            'valid_to'        => 'required|date|after:valid_from',
        ];
    }
}