<?php

namespace interactivesolutions\honeycombecommerceorders\app\forms\ecommerce\orders;

class HCECOrderInvoicesForm
{
    // name of the form
    protected $formID = 'e-commerce-orders-invoices';

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
            'storageURL' => route('admin.api.routes.e.commerce.orders.invoices'),
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
                    "fieldID"         => "number",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_invoices.number"),
                    "required"        => 1,
                    "requiredVisible" => 1,
                ],
                [
                    "type"            => "singleLine",
                    "fieldID"         => "order_id",
                    "label"           => trans("HCECommerceOrders::e_commerce_orders_invoices.order_id"),
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