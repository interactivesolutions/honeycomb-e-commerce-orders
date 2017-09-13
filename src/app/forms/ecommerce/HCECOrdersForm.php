<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\HCECCarriers;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECUserAddress;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderStates;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\payment\HCECOrderPaymentStatus;

class HCECOrdersForm
{
    // name of the form
    protected $formID = 'e-commerce-orders';

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
            'storageURL' => route('admin.api.routes.e.commerce.orders'),
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
                    "fieldID"         => "order_payment_status_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.order_payment_status_id"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.status"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECOrderPaymentStatus::get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["title"],
                    ],
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "order_state_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.order_state_id"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.status"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCECOrderStates::get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["title"],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "tracking_number",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.tracking_number"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.status"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "dependencies"    => [
                        [
                            'field_id'    => 'order_state_id',
                            'field_value' => ['shipped', 'delivered'],
                        ],
                        [
                            'field_id'    => 'order_payment_status_id',
                            'field_value' => 'payment-accepted',
                        ],
                    ],
                ],
                [
                    "type"            => "textArea",
                    "fieldID"         => "order_history_note",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.order_history_note"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.status"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "user_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.user_id"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCUsers::select('id', 'email')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["email"],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "reference",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.reference"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "payment",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.payment"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_price",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_price"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_price_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_price_before_tax"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "readonly"        => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "total_price_tax_amount",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_price_tax_amount"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "readonly"        => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "total_discounts",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_discounts"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "total_discounts_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_discounts_before_tax"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "readonly"        => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "total_discounts_tax_amount",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_discounts_tax_amount"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "readonly"        => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_paid",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_paid"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_paid_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_paid_before_tax"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "total_paid_tax_amount",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_paid_tax_amount"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "order_note",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.order_note"),
                    "tabID"           => trans("HCECommerceOrders::e_commerce_orders.tabs.info"),
                    "required"        => 0,
                    "requiredVisible" => 0,
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