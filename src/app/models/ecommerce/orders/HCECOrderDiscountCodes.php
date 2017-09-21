<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECOrderDiscountCodes extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_order_discount_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'order_id', 'title', 'code', 'type', 'amount', 'shipping_included', 'free_shipping'];

    /**
     * Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(HCECOrders::class, 'order_id', 'id');
    }
}