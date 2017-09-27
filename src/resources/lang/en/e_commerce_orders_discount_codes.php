<?php

return [
    'page_title'        => 'Order discount codes',
    'order_id'          => 'Order',
    'title'             => 'Title',
    'code'              => 'Code',
    'type'              => 'Type',
    'amount'            => 'Amount',
    'shipping_included' => 'Shipping included',
    'free_shipping'     => 'Free shipping',
    'discount_code'     => 'Discount code',
    'discount_text'     => 'Discount text',

    'types' => [
        'percentage' => 'Percentage',
        'fixed'      => 'Fixed price',
        'none'       => 'No discount',
    ],

    'percentage_discount_with_shipping'    => ':amount % discount to all cart',
    'percentage_discount_without_shipping' => ':amount % discount to cart products',
    'fixed_discount_with_shipping'         => ':amount € discount to all cart',
    'fixed_discount_without_shipping'      => ':amount € discount to cart products',
    'none_discount'                        => 'Free shipping',
];