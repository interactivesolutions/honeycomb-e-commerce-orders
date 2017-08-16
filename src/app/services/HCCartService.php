<?php

namespace interactivesolutions\honeycombecommerceorders\app\services;

use Illuminate\Http\Request;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECCarts;

class HCCartService
{
    const CART_NAME = 'default_value';

    /**
     * Cookie life time
     *
     * @var int - half year 60min * 24h * 180 days
     */
    protected $lifetime = 60 * 24 * 180;

    /**
     * Get cart id
     *
     * @param Request $request
     * @param $create
     * @return array|bool|false|int|string
     */
    public function getCartId(Request $request, $create)
    {
        $userId = auth()->id();

        $isValidGuestCart = $request->cookies->has(self::CART_NAME) && $this->isValidGuestCart($request->cookie(self::CART_NAME));

        if( $isValidGuestCart ) {
            $defaultCartId = $request->cookie(self::CART_NAME);

            if( $userId ) {
                $cartId = $this->mergeWithUserCart($defaultCartId, $userId);

                // clear cookie old
                cookie()->forget(self::CART_NAME);

                return $cartId;
            } else {
                // extend cookie time
                cookie()->queue(cookie(self::CART_NAME, $defaultCartId, $this->lifetime));

                return $defaultCartId;
            }
        } elseif( $userId ) {
            // clear cookie
            cookie()->forget(self::CART_NAME);

            // get cart id from user
            return $this->getUserCartId($userId, $create);
        } elseif( $create ) {

            // create cart
            $cart = $this->createCart();

            if( $cart ) {
                cookie()->queue(cookie(self::CART_NAME, $cart->id, $this->lifetime));

                return $cart->id;
            }
        } else {
            cookie()->forget(self::CART_NAME);
        }

        return false;
    }

    /**
     * Returns whether cart with given id exists and is not associated
     * with any user.
     *
     * @param int $cartId Cart ID.
     *
     * @return bool
     */
    public function isValidGuestCart($cartId)
    {
        $cart = $this->getCartInfo($cartId);

        return $cart && is_null($cart->user_id);
    }


    /**
     * Returns information about cart.
     *
     * @param int $cartId Cart ID.
     *
     * @return array|false
     */
    public function getCartInfo($cartId)
    {
        return HCECCarts::select('id', 'updated_at', 'user_id')->find($cartId);
    }

    /**
     * Moves cart contents to user cart and returns resulting cart ID.
     *
     * @param int $cartId Cart to merge from.
     * @param int $userId User that has the new cart.
     *
     * @return int
     */
    public function mergeWithUserCart($cartId, $userId)
    {
        $userCartId = $this->getUserCartId($userId);

        if( $userCartId ) {
            HCECCarts::copyCartItems($cartId, $userCartId);
            HCECCarts::deleteCart($cartId);

            return $userCartId;
        } else {
            HCECCarts::setCartInfo($cartId, $userId);

            return $cartId;
        }
    }

    /**
     * Retrieves user cart id.
     *
     * @param int $userId User ID.
     * @param bool $create Whether to create cart if none found.
     *
     * @return int|false
     */
    public function getUserCartId($userId, $create = false)
    {
        $cartId = HCECCarts::getUserCartId($userId);

        if( is_null($cartId) && $create ) {
            $cartId = $this->createCart($userId);
        }

        return $cartId ? $cartId->id : null;
    }

    /**
     * Creates new cart.
     *
     * @param int|null $userId User ID to associate with.
     *
     * @return int
     */
    public function createCart($userId = null)
    {
        return HCECCarts::create(['user_id' => $userId]);
    }
}