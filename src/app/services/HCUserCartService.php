<?php

namespace interactivesolutions\honeycombecommerceorders\app\services;

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
     * @return
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

        $this->checkStockBalance($goodsId, $combinationId, $finalAmount);

        $item->amount = $finalAmount;
        $item->save();

        return $item;
    }

    /**
     * Update the cart item with the given cart id.
     *
     * @param $cartItemId
     * @param $amount
     * @return
     * @throws \Exception
     */
    public function update($cartItemId, $amount)
    {
        $amount = $this->validateAmount($amount);

        $cartItem = HCECCartItems::select('id', 'goods_id', 'combination_id', 'cart_id')
            ->has('cart')
            ->find($cartItemId);

        if( is_null($cartItem) ) {
            throw new \Exception(trans('HCECommerceOrders::e_commerce_carts.errors.item_not_found'));
        }

        $this->checkStockBalance($cartItem->goods_id, $cartItem->combination_id, $amount);

        $cartItem->amount = $amount;
        $cartItem->save();

        return $cartItem;
    }

    /**
     * Remove the cart item with the given cart item id from the cart.
     *
     * @param string $cartItemId
     * @return void
     */
    public function remove($cartItemId)
    {
        HCECCartItems::where('id', $cartItemId)->forceDelete();
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
     * @throws \Exception
     */
    protected function checkStockBalance($goodsId, $combinationId, $amount)
    {
        // check if goods is available
        $available = HCECStockSummary::where([
            'goods_id'       => $goodsId,
            'combination_id' => $combinationId,
        ])->sum('on_sale');

        if( $available == 0 || $available < $amount ) {
            throw new \Exception(trans('HCECommerceOrders::e_commerce_carts.errors.not_enough', ['available' => $available]));
        }
    }
}