<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\HCECCarriers;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderAddress;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderCarriers;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderDetails;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderStates;

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

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_state()
    {
        return $this->belongsTo(HCECOrderStates::class, 'order_state_id', 'id');
    }

    /**
     * Relation to details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(HCECOrderDetails::class, 'order_id', 'id');
    }

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(HCUsers::class, 'user_id', 'id');
    }

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_address()
    {
        return $this->belongsTo(HCECUserAddress::class, 'user_address_id', 'id');
    }

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(HCECCarriers::class, 'carrier_id', 'id');
    }
    
    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_address()
    {
        return $this->hasOne(HCECOrderAddress::class, 'order_id', 'id');
    }

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_carriers()
    {
        return $this->hasOne(HCECOrderCarriers::class, 'order_id', 'id');
    }

}