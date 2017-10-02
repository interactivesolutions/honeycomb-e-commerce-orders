<?php
return [
    'page_title'                  => 'Orders',
    'order_state_id'              => 'Order state',
    'order_payment_status_id'     => 'Order payment status',
    'user_id'                     => 'User',
    'reference'                   => 'Reference',
    'payment'                     => 'Payment',
    'total_price'                 => 'Total price',
    'total_price_before_tax'      => 'Total price before tax',
    'total_price_tax_amount'      => 'Total price tax amount',
    'total_discounts'             => 'Total discounts',
    'total_discounts_before_tax'  => 'Total discounts before tax',
    'total_discounts_tax_amount'  => 'Total discounts tax amount',
    'total_paid'                  => 'Total paid',
    'total_paid_before_tax'       => 'Total paid before tax',
    'total_paid_tax_amount'       => 'Total paid tax amount',
    'order_note'                  => 'Order note',
    'order_history_note'          => 'Order history note',
    'total_unit_price'            => 'Total unit price',
    'total_unit_price_before_tax' => 'Total unit price before tax',
    'total_unit_price_tax_amount' => 'Total unit price tax amount',

    'order'          => 'Order',
    'order_date'     => 'Order date',
    'state'          => 'Sate',
    'payment_status' => 'Payment status',

    'tabs' => [
        'status' => 'Status',
        'info'   => 'Info',
    ],

    'errors' => [
        'order_canceled'                 => 'Order is already canceled. There is nothing you can do.',
        'payment_accepted_but_not_ready' => 'After "payment accept" order status must be "ready for processing"',

        'not_ready_for_processing'                => '"Processing in progress" can be selected when order status is "ready for processing"',
        'not_ready_for_shipment_after_processing' => '"Ready for shipment" can be selected when order status is "processing in progress"',
        'not_ready_for_shipment'                  => '"Order shipped" can be selected when order status is "ready for shipment"',
        'not_ready_for_delivered'                 => '"Order delivered" can be selected when order status is "shipped"',
        'waiting_for_stock_only_cancel'           => 'When order state is "waiting-for-stock" then you can only cancel order',
    ],
];