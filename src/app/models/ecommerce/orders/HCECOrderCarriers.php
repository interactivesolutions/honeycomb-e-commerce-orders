<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\HCECCarriers;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECOrderCarriers extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_order_carriers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'order_id', 'carrier_id', 'name', 'weight', 'shipping_price', 'shipping_price_before_tax', 'shipping_tax_amount', 'tax_name', 'tax_value', 'user_note'];

    /**
     * Relation to order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(HCECOrders::class, 'order_id', 'id');
    }

    /**
     * Relation to order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(HCECCarriers::class, 'carrier_id', 'id');
    }
}