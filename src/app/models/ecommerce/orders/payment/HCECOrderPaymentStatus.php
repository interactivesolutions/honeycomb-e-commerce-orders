<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\payment;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECOrderPaymentStatus extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_order_payment_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id'];

    /**
     * Appends title
     *
     * @var array
     */
    protected $appends = ['title'];

    /**
     * Title attribute
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitleAttribute()
    {
        return trans('HCECommerceOrders::e_commerce_orders_payment_status.' . $this->id);
    }

}