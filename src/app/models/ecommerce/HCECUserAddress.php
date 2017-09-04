<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombregions\app\models\regions\HCCountries;

class HCECUserAddress extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_users_address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'cart_id', 'form_name', 'first_name', 'last_name', 'email', 'country_id', 'street_address', 'city', 'district', 'postal_code', 'phone', 'notes', 'company_name', 'company_code', 'company_vat'];

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
    public function country()
    {
        return $this->belongsTo(HCCountries::class, 'country_id', 'id');
    }

    /**
     * Relation to cart table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo(HCECCarts::class, 'cart_id', 'id');
    }
}