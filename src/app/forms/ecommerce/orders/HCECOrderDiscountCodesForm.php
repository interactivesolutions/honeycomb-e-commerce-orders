<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce\orders;

class HCECOrderDiscountCodesForm
{
    // name of the form
    protected $formID = 'e-commerce-orders-discount-codes';

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
            'storageURL' => route('admin.api.routes.e.commerce.orders.discount.codes'),
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
                    "fieldID"         => "order_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_discount_codes.order_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "title",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_discount_codes.title"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "code",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_discount_codes.code"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "type",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_discount_codes.type"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "amount",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_discount_codes.amount"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "shipping_included",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_discount_codes.shipping_included"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "free_shipping",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_discount_codes.free_shipping"),
                    "required"        => 1,
                    "requiredVisible" => 1,
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