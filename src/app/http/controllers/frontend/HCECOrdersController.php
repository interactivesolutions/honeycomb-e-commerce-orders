<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\frontend;
use DB;
use HCLog;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECOrdersController extends HCBaseController
{
    /**
     * Get invoice
     *
     * @param $lang
     * @param $orderId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function invoice($lang, $orderId)
    {
        if( $lang == 'en' && request()->segment(2) == 'saskaita' ) {
            return redirect()->route('en.order.invoice', [$lang, $orderId]);
        } else if( $lang == 'lt' && request()->segment(2) == 'invoice' ) {
            return redirect()->route('lt.order.invoice', [$lang, $orderId]);
        }

        $order = HCECOrders::with([
            'details',
            'order_address',
            'order_carriers',
            'order_discount_code',
        ])->findOrFail($orderId);

        return hcview('HCECommerceOrders::order.invoice', compact('order'));
    }
}
