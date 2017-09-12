<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce\orders;

use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\combinations\HCECCombinations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;
use interactivesolutions\honeycombecommercewarehouse\app\models\ecommerce\HCECWarehouses;

class HCECOrderDetailsForm
{
    // name of the form
    protected $formID = 'e-commerce-orders-details';

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
            'storageURL' => route('admin.api.routes.e.commerce.orders.details'),
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
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.order_id"),
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
                    "type"            => "dropDownList",
                    "fieldID"         => "good_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.good_id"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                    "options"         => HCECGoods::with('translations')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["translations.{lang}.label"],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "combination_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.combination_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "warehouse_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.warehouse_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCECWarehouses::select('id', 'name')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 1,
                        "showNodes"              => ["name"],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "tax_name",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.tax_name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "tax_value",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.tax_value"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "amount",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.amount"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "reference",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.reference"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "name",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "price",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.price"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "price_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.price_before_tax"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "price_tax_amount",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.price_tax_amount"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "total_price",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.total_price"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "total_price_before_tax",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.total_price_before_tax"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "total_price_tax_amount",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_details.total_price_tax_amount"),
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