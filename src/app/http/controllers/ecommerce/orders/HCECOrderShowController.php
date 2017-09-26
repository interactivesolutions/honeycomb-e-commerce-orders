<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\ecommerce\orders;

use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECOrderShowController extends HCBaseController
{
    /**
     * Returning configured admin view
     *
     * @param $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($orderId)
    {
        $order = HCECOrders::findOrFail($orderId);

        $order->load(['details.warehouse', 'order_address', 'order_carriers.carrier', 'order_discount_code', 'order_state', 'order_payment_status']);

        $config = [
            'title' => trans('HCECommerceOrders::e_commerce_order_show.page_title'),
            'order' => $order,
        ];

        return hcview('HCECommerceOrders::order.show', compact('config'));
    }

}
