<?php

namespace interactivesolutions\honeycombecommerceorders\database\seeds;

use Illuminate\Database\Seeder;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderStates;

class HCECOrderStatesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            [
                'id' => 'ready-for-processing',
            ],
            [
                'id' => 'processing-in-progress',
            ],
            [
                'id' => 'ready-for-shipment',
            ],
            [
                'id' => 'shipped',
            ],
            [
                'id' => 'delivered',
            ],
            [
                'id' => 'canceled',
            ],
            [
                'id' => 'canceled-and-restored',
            ],
        ];

        foreach ( $states as $key => $state ) {
            HCECOrderStates::firstOrCreate($state);
        }
    }
}
