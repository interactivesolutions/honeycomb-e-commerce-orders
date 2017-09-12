<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce\orders;

class HCECOrderStatesForm
{
    // name of the form
    protected $formID = 'e-commerce-orders-states';

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
                    "fieldID"         => "title",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_states.title"),
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