<?php

namespace interactivesolutions\honeycombecommerceorders\app\services;

use Illuminate\Http\Request;
use interactivesolutions\honeycombecommercegoods\app\helpers\PriceHelper;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\carts\HCECCartItems;

class HCCart
{
    /**
     * Cart content
     *
     * @var void
     */
    public $items;

    /**
     * Cart id
     *
     * @var
     */
    public $cartId;

    /**
     * HCCart constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->items = $this->getItemsContent($request);
    }

    /**
     * Get cart content
     *
     * @return array|bool|false|int|string
     */
    public function getContent()
    {
        return $this->getCartContent();
    }

    /**
     * Get formatted cart content
     *
     * @return array
     */
    protected function getCartContent()
    {
        return [
            'cart_id'          => $this->cartId,
            'count'            => $this->count(),
            'price'            => $this->price(),
            'price_before_tax' => $this->priceBeforeTax(),
            'items'            => $this->getItems(),
        ];
    }

    /**
     * Get cart items content
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    protected function getItemsContent(Request $request)
    {
        $cartId = app(HCCartService::class)->getCartId($request, true);

        $this->cartId = $cartId;

        $cartItems = HCECCartItems::byCartId($cartId)->get();

        return $this->getGoods($cartItems);
    }

    /**
     * Get the number of items in the cart.
     *
     * @return int|float
     */
    public function count()
    {
        $items = $this->getItems();

        return $items->sum('selected_amount');
    }

    /**
     * Items getter
     *
     * @return void
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Get the total price of the items in the cart.
     */
    public function price()
    {
        $items = $this->getItems();

        $total = $items->reduce(function ($total, $cartItem) {
            return $total + (array_get($cartItem, 'prices.total_price'));
        }, 0);

        return PriceHelper::truncate($total);
    }

    /**
     * Get the total price of the items in the cart.
     */
    public function priceBeforeTax()
    {
        $items = $this->getItems();

        $total = $items->reduce(function ($total, $cartItem) {
            return $total + (array_get($cartItem, 'prices.total_price_before_tax'));
        }, 0);

        return PriceHelper::truncate($total);
    }

    /**
     * Get goods by cart item
     *
     * @param $cartItems
     * @return array
     */
    protected function getGoods($cartItems)
    {
        $goods = [];

        return $goods;
    }
}