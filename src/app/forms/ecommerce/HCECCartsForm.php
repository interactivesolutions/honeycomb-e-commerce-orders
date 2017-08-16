<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce;

class HCECCartsForm
{
    // name of the form
    protected $formID = 'e-commerce-carts';

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
            'storageURL' => route('admin.api.routes.e.commerce.carts'),
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
    "fieldID"         => "user_id",
    "label"           => trans("HCECommerceOrders::e_commerce_carts.user_id"),
    "required"        => 0,
    "requiredVisible" => 0,
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