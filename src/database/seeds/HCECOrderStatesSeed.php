<?php

namespace interactivesolutions\honeycombecommerceorders\database\seeds;

use Illuminate\Database\Seeder;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderStates;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderStatesTranslations;

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
                'id' => 'awaiting-bank-wire-payment',
            ],
            [
                'id' => 'payment-accepted',
            ],
            [
                'id' => 'processing-in-progress',
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
        ];

        $translations = [
            [
                [
                    'language_code' => 'lt',
                    'label'         => 'Laukiama apmokėjimo pavedimu',
                ],
                [
                    'language_code' => 'en',
                    'label'         => 'Awaiting bank wire payment',
                ],
            ],
            [
                [
                    'language_code' => 'lt',
                    'label'         => 'Mokėjimas gautas',
                ],
                [
                    'language_code' => 'en',
                    'label'         => 'Payment accepted',
                ],
            ],
            [
                [
                    'language_code' => 'lt',
                    'label'         => 'Processing in progress',
                ],
                [
                    'language_code' => 'en',
                    'label'         => 'Užsakymas vykdomas',
                ],
            ],
            [
                [
                    'language_code' => 'lt',
                    'label'         => 'Užsakymas išsiųstas',
                ],
                [
                    'language_code' => 'en',
                    'label'         => 'Shipped',
                ],
            ],
            [
                [
                    'language_code' => 'lt',
                    'label'         => 'Pristatyta',
                ],
                [
                    'language_code' => 'en',
                    'label'         => 'Delivered',
                ],
            ],
            [
                [
                    'language_code' => 'lt',
                    'label'         => 'Atšauktas',
                ],
                [
                    'language_code' => 'en',
                    'label'         => 'Canceled',
                ],
            ],
        ];

        foreach ( $states as $key => $state ) {
            $record = HCECOrderStates::where('id', $state['id'])->first();

            if( is_null($record) ) {
                $record = HCECOrderStates::create($state);
            }

            foreach ( $translations[$key] as $translation ) {

                $trans = HCECOrderStatesTranslations::where([
                    'record_id'     => $record->id,
                    'language_code' => $translation['language_code'],
                ])->first();

                if( is_null($trans) ) {
                    HCECOrderStatesTranslations::create($translation + [
                            'record_id' => $record->id,
                        ]);
                }
            }
        }
    }
}
