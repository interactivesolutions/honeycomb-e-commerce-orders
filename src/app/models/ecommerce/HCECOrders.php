<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombcore\models\traits\CustomAppends;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderAddress;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderCarriers;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderDetails;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderDiscountCodes;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderHistory;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderInvoices;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderStates;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\payment\HCECOrderPaymentStatus;

class HCECOrders extends HCUuidModel
{
    use CustomAppends;

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
    protected $fillable = [
        'id', 'order_state_id', 'order_payment_status_id', 'user_id', 'reference', 'payment',
        'total_price', 'total_price_before_tax', 'total_price_tax_amount',
        'total_discounts', 'total_discounts_before_tax', 'total_discounts_tax_amount',
        'total_paid', 'total_paid_before_tax', 'total_paid_tax_amount',
        'order_note',
        'total_unit_price', 'total_unit_price_before_tax', 'total_unit_price_tax_amount',
    ];

    /**
     * Rules url
     *
     * @return string
     */
    public function getContentUrlAttribute()
    {
        return route('admin.routes.e.commerce.orders.{_id}.index', $this->id);
    }

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
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_payment_status()
    {
        return $this->belongsTo(HCECOrderPaymentStatus::class, 'order_payment_status_id', 'id');
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
     * Relation to details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        return $this->hasMany(HCECOrderHistory::class, 'order_id', 'id');
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

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order_invoice()
    {
        return $this->hasOne(HCECOrderInvoices::class, 'order_id', 'id');
    }

    /**
     * Relation to table
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order_discount_code()
    {
        return $this->hasOne(HCECOrderDiscountCodes::class, 'order_id', 'id');
    }

}