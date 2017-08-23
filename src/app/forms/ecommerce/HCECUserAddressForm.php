<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombregions\app\models\regions\HCCountries;

class HCECUserAddressForm
{
    // name of the form
    protected $formID = 'e-commerce-address';

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
            'storageURL' => route('admin.api.routes.e.commerce.address'),
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
                    "fieldID"         => "user_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.user_id"),
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
                    "fieldID"         => "form_name",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.form_name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "first_name",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.first_name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "last_name",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.last_name"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "email",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.email"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ],
                [
                    "type"            => "dropDownList",
                    "fieldID"         => "country_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.country_id"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                    "options"         => HCCountries::select('id', 'translation_key')->get(),
                    "search"          => [
                        "maximumSelectionLength" => 1,
                        "minimumSelectionLength" => 0,
                        "showNodes"              => ["translation"],
                    ],
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "street_address",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.street_address"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "city",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.city"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "district",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.district"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "postal_code",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.postal_code"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "phone",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.phone"),
                    "required"        => 0,
                    "requiredVisible" => 0,
                ], [
                    "type"            => "singleLine",
                    "fieldID"         => "notes",
                    "label"           => trans("HCECommerceOrders::e_commerce_address.notes"),
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