<?php

namespace interactivesolutions\honeycombecommerceorders\database\seeds;

use Illuminate\Database\Seeder;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\payment\HCECOrderPaymentStatus;

class HCECOrderPaymentStatusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'id' => 'awaiting-bank-wire-payment',
            ],
            [
                'id' => 'payment-in-progress',
            ],
            [
                'id' => 'payment-accepted',
            ],
            [
                'id' => 'payment-failed',
            ],
        ];

        foreach ( $statuses as $key => $status ) {
            HCECOrderPaymentStatus::firstOrCreate($status);
        }
    }
}
