<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECDiscountCodeUsages extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_discount_code_usages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'order_id', 'discount_code_id'];

    /**
     * Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(HCECOrders::class, 'order_id', 'id');
    }

    /**
     * Discount code
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discount_code()
    {
        return $this->belongsTo(HCECDiscountCodes::class, 'discount_code_id', 'id');
    }
}