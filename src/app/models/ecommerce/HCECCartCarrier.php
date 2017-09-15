<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCModel;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\HCECCarriers;

class HCECCartCarrier extends HCModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_cart_carrier';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cart_id', 'carrier_id', 'note'];

    /**
     * Relation to cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo(HCECCarts::class, 'cart_id', 'id');
    }

    /**
     * Relation to cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(HCECCarriers::class, 'carrier_id', 'id');
    }
}