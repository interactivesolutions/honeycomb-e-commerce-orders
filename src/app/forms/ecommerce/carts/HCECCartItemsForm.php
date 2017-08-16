<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce\carts;

class HCECCartItemsForm
{
    // name of the form
    protected $formID = 'e-commerce-carts-items';

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
            'storageURL' => route('admin.api.routes.e.commerce.carts.items'),
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
    "fieldID"         => "active",
    "label"           => trans("HCECommerceOrders::e_commerce_carts_items.active"),
    "required"        => 0,
    "requiredVisible" => 0,
],[
    "type"            => "singleLine",
    "fieldID"         => "cart_id",
    "label"           => trans("HCECommerceOrders::e_commerce_carts_items.cart_id"),
    "required"        => 1,
    "requiredVisible" => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "goods_id",
    "label"           => trans("HCECommerceOrders::e_commerce_carts_items.goods_id"),
    "required"        => 1,
    "requiredVisible" => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "combination_id",
    "label"           => trans("HCECommerceOrders::e_commerce_carts_items.combination_id"),
    "required"        => 1,
    "requiredVisible" => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "amount",
    "label"           => trans("HCECommerceOrders::e_commerce_carts_items.amount"),
    "required"        => 1,
    "requiredVisible" => 1,
],
            ],
        ];

        if ($this->multiLanguage)
            $form['availableLanguages'] = getHCContentLanguages();

        if (!$edit)
            return $form;

        //Make changes to edit form if needed
        // $form['structure'][] = [];

        return $form;
    }
}