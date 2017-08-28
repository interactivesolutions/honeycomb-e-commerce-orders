<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce;

use interactivesolutions\honeycombacl\app\models\HCUsers;
use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommercecarriers\app\models\ecommerce\HCECCarriers;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\carts\HCECCartItems;

class HCECCarts extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_carts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'user_id'];

    /**
     * Relation to user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(HCUsers::class, 'user_id', 'id');
    }

    /**
     * Cart items
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(HCECCartItems::class, 'cart_id', 'id');
    }

    /**
     * Cart carrier
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function carrier()
    {
        return $this->belongsToMany(HCECCarriers::class, HCECCartCarrier::getTableName(), 'cart_id', 'carrier_id')->withTimestamps()->withPivot('note');
    }

    /**
     * User cart id
     *
     * @param $userId
     * @return mixed
     */
    public static function getUserCartId($userId)
    {
        return (new static())->select('id')->where('user_id', $userId)->first();
    }

    /**
     * Sets cart properties.
     *
     * @param int $cartId Cart ID.
     * @param $userId
     * @return int
     */
    public static function setCartInfo($cartId, $userId)
    {
        return (new static())->where('id', $cartId)->update(['user_id' => $userId]);
    }

    /**
     * Copy cart items
     *
     * @param $guestCartId
     * @param $loggedCartId
     */
    public static function copyCartItems($guestCartId, $loggedCartId)
    {
        $items = HCECCartItems::where('cart_id', $guestCartId)->get();

        if( ! $items->isEmpty() ) {
            foreach ( $items as $item ) {

                $cartItem = HCECCartItems::firstOrNew([
                    'cart_id'        => $loggedCartId,
                    'goods_id'       => $item->goods_id,
                    'combination_id' => $item->combination_id,
                ]);

                $cartItem->amount = $item->amount;
                $cartItem->save();
            }
        }
    }

    /**
     * Delete cart
     *
     * @param $cartId
     */
    public static function deleteCart($cartId)
    {
        // delete cart items
        HCECCartItems::where('cart_id', $cartId)->forceDelete();

        // delete cart carrier
        HCECCartCarrier::where('cart_id', $cartId)->delete();

        // delete cart
        (new static())->where('id', $cartId)->forceDelete();
    }
}