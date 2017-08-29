<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce;

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
                    "type"            => "singleLine",
                    "fieldID"         => "order_state_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.order_state_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "user_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.user_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "user_address_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.user_address_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "carrier_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.carrier_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "reference",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.reference"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "payment",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.payment"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_price",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_price"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_price_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_price_before_tax"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_discounts",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_discounts"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_discounts_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_discounts_before_tax"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_paid",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_paid"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "total_paid_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.total_paid_before_tax"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "shipping_price",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.shipping_price"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "shipping_price_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.shipping_price_before_tax"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "carrier_note",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.carrier_note"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "order_note",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders.order_note"),
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