<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce\orders;

class HCECOrderStatesForm
{
    // name of the form
    protected $formID = 'e-commerce-orders-states';

    // is form multi language
    protected $multiLanguage = 1;

    /**
     * Creating form
     *
     * @param bool $edit
     * @return array
     */
    public function createForm(bool $edit = false)
    {
        $form = [
            'storageURL' => route('admin.api.routes.e.commerce.orders.states'),
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
    "fieldID"         => "translations.label",
    "label"           => trans("HCECommerceOrders::e_commerce_orders_states.label"),
    "required"        => 1,
    "requiredVisible" => 1,
    "tabID"           => trans('HCTranslations::core.translations'),
    "multiLanguage"   => 1,
],[
    "type"            => "singleLine",
    "fieldID"         => "translations.description",
    "label"           => trans("HCECommerceOrders::e_commerce_orders_states.description"),
    "required"        => 0,
    "requiredVisible" => 0,
    "tabID"           => trans('HCTranslations::core.translations'),
    "multiLanguage"   => 1,
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