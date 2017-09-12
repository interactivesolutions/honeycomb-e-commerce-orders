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
    protected $fillable = ['id', 'order_id', 'good_id', 'combination_id', 'warehouse_id', 'tax_name', 'tax_value', 'amount', 'reference', 'name', 'price', 'price_before_tax', 'price_tax_amount', 'total_price', 'total_price_before_tax', 'total_price_tax_amount'];

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