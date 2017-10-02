<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\goods\combinations\HCECCombinations;
use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;
use interactivesolutions\honeycombecommercewarehouse\app\models\ecommerce\HCECWarehouses;

class HCECOrderDetails extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_order_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'order_id', 'good_id', 'combination_id', 'warehouse_id', 'tax_name', 'tax_value', 'amount', 'reference', 'name', 'is_pre_ordered',
        'price', 'price_before_tax', 'price_tax_amount',
        'total_price', 'total_price_before_tax', 'total_price_tax_amount',
        'unit_price', 'unit_price_before_tax', 'unit_price_tax_amount',
        'discount_type', 'discount_amount',
        'discounts', 'discounts_before_tax', 'discounts_tax_amount',
    ];

    /**
     * Pre ordered query scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsPreOrdered($query)
    {
        return $query->where(function($query) {
            $query->where('is_pre_ordered', '1');
        });
    }

    /**
     * Not pre ordered query scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeIsNotPreOrdered($query)
    {
        return $query->where(function($query) {
            $query->where('is_pre_ordered', '0');
        });
    }

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(HCECOrders::class, 'order_id', 'id');
    }

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function good()
    {
        return $this->belongsTo(HCECGoods::class, 'good_id', 'id');
    }

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function combination()
    {
        return $this->belongsTo(HCECCombinations::class, 'combination_id', 'id');
    }

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function warehouse()
    {
        return $this->belongsTo(HCECWarehouses::class, 'warehouse_id', 'id');
    }
}