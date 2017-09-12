<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce\orders;

use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderHistory;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderStates;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\payment\HCECOrderPaymentStatus;

class HCECOrderHistoryForm
{
    // name of the form
    protected $formID = 'e-commerce-orders-history';

    // is form multi language
    protected $multiLanguage = 0;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.routes.e.commerce.orders.history'),
            'buttons'    => [
                [
                    "class" => "col-centered",
                    "label" => trans('HCTranslations::core.buttons.submit'),
                    "type"  => "submit",
                ],
            ],
            'structure'  => [
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "order_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_history.order_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECOrders::select('id', 'reference')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["reference"],
                    ],
                ],
                [
                    "type"            => "radioList",
                    "fieldID"         => "type",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_history.type"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECOrderHistory::getTableEnumList('type', 'label', 'HCECommerceOrders::e_commerce_orders_history.types.'),
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "order_state_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_history.order_state_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECOrderStates::get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["title"],
                    ],
                    "dependencies"    => [
                        [
                            'field_id'    => 'type',
                            'field_value' => 'order-state',
                        ],
                    ],
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "order_payment_status_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_history.order_payment_status_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECOrderPaymentStatus::get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["title"],
                    ],
                    "dependencies"    => [
                        [
                            'field_id'    => 'type',
                            'field_value' => 'payment-status',
                        ],
                    ],
                ],
                [
                    "type"            => "textArea",
                    "fieldID"         => "note",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_history.note"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "rows"            => 10,
                ],
            ],
        ];

        if( $this->multiLanguage )
            $form['availableLanguages'] = getHCContentLanguages();

        if( ! $edit )
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }
}