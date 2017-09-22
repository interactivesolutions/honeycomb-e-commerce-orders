<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce;

use interactivesolutions\honeycombcore\models\HCModel;
use interactivesolutions\honeycombecommercepricerules\app\models\ecommerce\pricerules\HCECDiscountCodes;

class HCECCartDiscountCode extends HCModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_cart_discount_code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['cart_id', 'discount_code_id'];

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
     * Relation to discount code
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discount_code()
    {
        return $this->belongsTo(HCECDiscountCodes::class, 'discount_code_id', 'id');
    }
}