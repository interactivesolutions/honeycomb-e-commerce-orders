<?php

namespace interactivesolutions\honeycombecommerceorders\app\listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderInvoices;

class HCECDeleteGeneratedInvoiceNumber
{
    /**
     * Handle the event.
     *
     * @param  HCECOrderPaymentAccepted $event
     * @return void
     */
    public function handle($event)
    {
//        HCECOrderInvoices::where(['order_id' => $event->order->id])->delete();
//
//        info('deleted invoice number of order: ' . $event->order->reference);
    }
}
