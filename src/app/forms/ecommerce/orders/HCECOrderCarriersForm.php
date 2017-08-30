<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce\orders;

use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\HCECCarriers;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECOrderCarriersForm
{
    // name of the form
    protected $formID = 'e-commerce-orders-carriers';

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
            'storageURL' => route('admin.api.routes.e.commerce.orders.carriers'),
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
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.order_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECOrders::select('id', 'reference')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["reference"],
                    ],
                ],[
                    "type"            => "dropDownList",
                    "fieldID"         => "carrier_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.carrier_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECCarriers::select('id', 'label')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["label"],
                    ],
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "name",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "weight",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.weight"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "shipping_price",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.shipping_price"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "shipping_price_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.shipping_price_before_tax"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "shipping_tax_amount",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.shipping_tax_amount"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "tax_name",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.tax_name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "tax_value",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.tax_value"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "textArea",
                    "fieldID"         => "user_note",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_carriers.user_note"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "rows"            => 5,
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