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
     * Get cart content
     *
     * @param Request $request
     * @param null $userId - cart content by user id
     * @param null $cartId - cart content by given cart id
     * @return array|bool|false|int|string
     */
    public function getContent(Request $request, $userId = null, $cartId = null)
    {
        $this->items = $this->getItemsContent($request, $userId, $cartId);

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
            'cart_id'                   => $this->cartId,
            'count'                     => $this->count(),
            'price'                     => $this->price(),
            'price_before_tax'          => $this->priceBeforeTax(),
            'price_tax_amount'          => $this->priceTaxAmount(),
            'unit_price'                => $this->unitPrice(),
            'unit_price_before_tax'     => $this->unitPriceBeforeTax(),
            'unit_price_tax_amount'     => $this->unitPriceTaxAmount(),
            'items'                     => $this->getItems(),
        ];
    }

    /**
     * Get cart items content
     *
     * @param Request $request
     * @param $userId
     * @param $cartId
     * @return \Illuminate\Support\Collection
     */
    protected function getItemsContent(Request $request, $userId, $cartId)
    {
        if( $userId && is_null($cartId) ) {
            $cartId = app(HCCartService::class)->getUserCartId($userId);
        } else if( is_null($cartId) ) {
            $cartId = app(HCCartService::class)->getCartId($request, false);
        }

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

        return PriceHelper::round($total);
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

        return PriceHelper::round($total);
    }

    /**
     * Get the total price of the items in the cart.
     */
    public function priceTaxAmount()
    {
        $items = $this->getItems();

        $total = $items->reduce(function ($total, $cartItem) {
            return $total + (array_get($cartItem, 'prices.total_price_tax_amount'));
        }, 0);

        return PriceHelper::round($total);
    }

    /**
     * Get the total price of the items in the cart.
     */
    public function unitPrice()
    {
        $items = $this->getItems();

        $total = $items->reduce(function ($total, $cartItem) {
            return $total + (array_get($cartItem, 'prices.total_unit_price'));
        }, 0);

        return PriceHelper::round($total);
    }

    /**
     * Get the total price of the items in the cart.
     */
    public function unitPriceBeforeTax()
    {
        $items = $this->getItems();

        $total = $items->reduce(function ($total, $cartItem) {
            return $total + (array_get($cartItem, 'prices.total_unit_price_before_tax'));
        }, 0);

        return PriceHelper::round($total);
    }

    /**
     * Get the total price of the items in the cart.
     */
    public function unitPriceTaxAmount()
    {
        $items = $this->getItems();

        $total = $items->reduce(function ($total, $cartItem) {
            return $total + (array_get($cartItem, 'prices.total_unit_price_tax_amount'));
        }, 0);

        return PriceHelper::round($total);
    }

    /**
     * Get goods by cart item
     *
     * @param $cartItems
     * @return array
     */
    protected function getGoods($cartItems)
    {
        $goods = collect([]);

        $cartItems->load([
            'goods' => function ($query) {
                $query->with([
                    'images' => function ($query) {
                        $query->orderBy('position');
                    },
                    'translations',
                    'stock_summary',
                    'tax.translations',
                ]);
            }]);

        foreach ( $cartItems as $cartItem ) {
            $item = [];

            $item['selected_amount'] = $cartItem->amount;
            $item['cart_item_id'] = $cartItem->id;
            $item['goods_id'] = $cartItem->goods_id;
            $item['prices'] = [
                'price'                           => PriceHelper::round($cartItem->goods->price),
                'price_before_tax'                => PriceHelper::round($cartItem->goods->price_before_tax),
                'price_tax_amount'                => PriceHelper::round($cartItem->goods->price_tax_amount),

                'unit_price'                      => PriceHelper::round($cartItem->goods->price),
                'unit_price_before_tax'           => PriceHelper::round($cartItem->goods->price_before_tax),
                'unit_price_tax_amount'           => PriceHelper::round($cartItem->goods->price_tax_amount),

                'total_unit_price'                => PriceHelper::round($cartItem->amount * $cartItem->goods->price),
                'total_unit_price_before_tax'     => PriceHelper::round($cartItem->amount * $cartItem->goods->price_before_tax),
                'total_unit_price_tax_amount'     => PriceHelper::round($cartItem->amount * $cartItem->goods->price_tax_amount),

                'total_price'                     => PriceHelper::round($cartItem->amount * $cartItem->goods->price),
                'total_price_before_tax'          => PriceHelper::round($cartItem->amount * $cartItem->goods->price_before_tax),
                'total_price_tax_amount'          => PriceHelper::round($cartItem->amount * $cartItem->goods->price_tax_amount),
            ];

            $goods[] = $item;
        }

        return $goods;
    }
}