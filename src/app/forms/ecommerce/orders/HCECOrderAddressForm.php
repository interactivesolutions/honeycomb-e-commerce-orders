<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce\orders;

use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECOrderAddressForm
{
    // name of the form
    protected $formID = 'e-commerce-orders-address';

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
            'storageURL' => route('admin.api.routes.e.commerce.orders.address'),
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
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.order_id"),
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
                    "type"            => "singleLine",
                    "fieldID"         => "email",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.email"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "first_name",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.first_name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "last_name",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.last_name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "country",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.country"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "textArea",
                    "fieldID"         => "street_address",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.street_address"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "rows"            => 3,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "city",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.city"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "district",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.district"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "postal_code",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.postal_code"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "phone",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.phone"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],[
                    "type"            => "singleLine",
                    "fieldID"         => 'company_name',
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.company_name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],[
                    "type"            => "singleLine",
                    "fieldID"         => 'company_code',
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.company_code"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],[
                    "type"            => "singleLine",
                    "fieldID"         => 'company_vat',
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.company_vat"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "textArea",
                    "fieldID"         => "notes",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_address.notes"),
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