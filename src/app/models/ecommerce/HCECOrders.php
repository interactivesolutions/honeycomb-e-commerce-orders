<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECOrders extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'order_state_id', 'user_id', 'user_address_id', 'carrier_id', 'reference', 'payment', 'total_price', 'total_price_before_tax', 'total_discounts', 'total_discounts_before_tax', 'total_paid', 'total_paid_before_tax', 'shipping_price', 'shipping_price_before_tax', 'carrier_note', 'order_note'];
}