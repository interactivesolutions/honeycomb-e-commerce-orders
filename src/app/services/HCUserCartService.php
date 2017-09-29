<?php

namespace interactivesolutions\honeycombecommerceorders\app\services;

use interactivesolutions\honeycombecommercegoods\app\models\ecommerce\HCECGoods;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\carts\HCECCartItems;
use interactivesolutions\honeycombecommercewarehouse\app\models\ecommerce\warehouses\stock\HCECStockSummary;

class HCUserCartService
{
    /**
     * Add an item to the cart.
     *
     * @param $cartId
     * @param $goodsId
     * @param $combinationId
     * @param $amount
     * @return array
     * @throws \Exception
     */
    public function add($cartId, $goodsId, $combinationId, $amount = 1)
    {
        if( is_null($cartId) ) {
            throw new \Exception(trans('HCECommerceOrders::e_commerce_carts.errors.not_found'));
        }

        $amount = $this->validateAmount($amount);

        $item = HCECCartItems::firstOrNew([
            'cart_id'        => $cartId,
            'goods_id'       => $goodsId,
            'combination_id' => $combinationId,
        ]);

        $finalAmount = $item->amount + $amount;

        $typeAdded = $this->checkStockBalance($goodsId, $combinationId, $finalAmount);

        $item->amount = $finalAmount;
        $item->save();

        return [$typeAdded, $item];
    }

    /**
     * Update the cart item with the given cart id.
     *
     * @param $cartId
     * @param $cartItemId
     * @param $amount
     * @return array
     * @throws \Exception
     */
    public function update($cartId, $cartItemId, $amount)
    {
        $amount = $this->validateAmount($amount);

        $cartItem = HCECCartItems::select('id', 'goods_id', 'combination_id', 'cart_id')
            ->where('cart_id', $cartId)
            ->has('cart')
            ->find($cartItemId);

        if( is_null($cartItem) ) {
            // log data
            info(sprintf("cart item is null -> cartId: %s, itemId: %s, amount: %s", $cartId, $cartItemId, $amount));

            throw new \Exception(trans('HCECommerceOrders::e_commerce_carts.errors.item_not_found'));
        }

        $typeAdded = $this->checkStockBalance($cartItem->goods_id, $cartItem->combination_id, $amount);

        $cartItem->amount = $amount;
        $cartItem->save();

        return [$typeAdded, $cartItem];
    }

    /**
     * Remove the cart item with the given cart item id from the cart.
     *
     * @param $cartId
     * @param string $cartItemId
     * @return void
     */
    public function remove($cartId, $cartItemId)
    {
        $cartItem = HCECCartItems::where('id', $cartItemId)
            ->where('cart_id', $cartId)
            ->has('cart')->first();

        if( $cartItem ) {
            $cartItem->forceDelete();
        }
    }

    /**
     * Set up amount
     *
     * @param $amount
     * @return int
     */
    protected function validateAmount($amount)
    {
        if( $amount < 1 ) {
            $amount = 1;
        } elseif( $amount >= 1000 ) {
            $amount = 1000;
        }

        return $amount;
    }

    /**
     * Check stock balance of goods left
     *
     * @param $goodsId
     * @param $combinationId
     * @param $amount
     * @return string
     * @throws \Exception
     */
    protected function checkStockBalance($goodsId, $combinationId, $amount)
    {
        // check if goods is available
        $stocks = HCECStockSummary::where([
            'good_id'        => $goodsId,
            'combination_id' => $combinationId,
        ])->get();

        $available = $stocks->sum('on_sale');

        if( $available == 0 || $available < $amount ) {

            // TODO Improve when multiple warehouses will be used
            $good = HCECGoods::find($goodsId);

            if( is_null($good) || ! $good->allow_pre_order ) {
                throw new \Exception(trans('HCECommerceOrders::e_commerce_carts.errors.not_enough', ['available' => $available]));
            }

            $availableToPreOrder = $good->pre_order_count - $stocks->sum('pre_ordered');

            if( $availableToPreOrder < 0 || $amount > $availableToPreOrder ) {
                throw new \Exception(trans('HCECommerceOrders::e_commerce_carts.errors.not_enough_to_pre_order', ['available' => $availableToPreOrder]));
            }

            return 'reserved';
        }

        return 'normal';
    }
}