<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders;

use interactivesolutions\honeycombcore\models\HCUuidModel;

class HCECOrderStates extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_order_states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id'];

    /**
     * Appends title
     *
     * @var array
     */
    protected $appends = ['title'];

    /**
     * Title attribute
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function getTitleAttribute()
    {
        return trans('HCECommerceOrders::e_commerce_orders_states.' . $this->id);
    }

    /**
     * Relation to details
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        return $this->hasMany(HCECOrderHistory::class, 'order_state_id', 'id');
    }

}
