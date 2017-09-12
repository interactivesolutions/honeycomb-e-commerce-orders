<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\payment\HCECOrderPaymentStatus;

class HCECOrderHistory extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_order_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'order_id', 'type', 'order_state_id', 'order_payment_status_id', 'note'];

    /**
     * Get appendable items
     *
     * @var array
     */
    protected $appends = ['type_translated'];

    /**
     * Attribute value
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTypeTranslatedAttribute()
    {
        return trans('HCECommerceOrders::e_commerce_orders_history.types.' . $this->type);
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
}