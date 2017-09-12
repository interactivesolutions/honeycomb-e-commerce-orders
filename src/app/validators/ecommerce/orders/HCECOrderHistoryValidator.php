<?php

namespace interactivesolutions\honeycombecommerceorders\app\validators\ecommerce\orders;

use interactivesolutions\honeycombcore\http\controllers\HCCoreFormValidator;

class HCECOrderHistoryValidator extends HCCoreFormValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'order_id'                => 'required',
            'type'                    => 'required|in:order-state,payment-status',
            'order_state_id'          => 'required_if:type,order-state',
            'order_payment_status_id' => 'required_if:type,payment-status',
        ];
    }
}