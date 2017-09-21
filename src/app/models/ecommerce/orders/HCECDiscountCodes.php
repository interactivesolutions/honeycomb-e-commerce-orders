<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECDiscountCodes extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_discount_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'title', 'code', 'type', 'shipping_included', 'free_shipping', 'amount', 'total_available', 'valid_from', 'valid_to', 'minimum_amount'];

    /**
     * User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(HCUsers::class, 'user_id', 'id');
    }

    /**
     * Has many usages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function usages()
    {
        return $this->hasMany(HCECDiscountCodeUsages::class, 'discount_code_id', 'id');
    }

    /**
     * Orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(HCECOrders::class, HCECDiscountCodes::getTable(), 'discount_code_id', 'order_id')->withPivot('id', 'deleted_at')->withTimestamps();
    }
}