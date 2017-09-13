<?php

namespace interactivesolutions\honeycombecommerceorders\app\listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use interactivesolutions\honeycombecommerceorders\app\events\HCECOrderPaymentAccepted;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderInvoices;

class HCECGenerateInvoiceNumber
{
    /**
     * Handle the event.
     *
     * @param  HCECOrderPaymentAccepted $event
     * @return void
     */
    public function handle(HCECOrderPaymentAccepted $event)
    {
        $latestNumber = HCECOrderInvoices::max('number');

        $number = $latestNumber ? $latestNumber+1 : 1;

        HCECOrderInvoices::create([
            'number'   => $number,
            'order_id' => $event->order->id,
        ]);

        info('generate invoice number of order: ' . $event->order->reference);
    }
}
