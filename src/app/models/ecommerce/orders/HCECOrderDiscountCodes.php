<?php

namespace interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders;

use interactivesolutions\honeycombcore\models\HCUuidModel;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECOrderDiscountCodes extends HCUuidModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hc_order_discount_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'order_id', 'title', 'code', 'type', 'amount', 'shipping_included', 'free_shipping'];

    /**
     * Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(HCECOrders::class, 'order_id', 'id');
    }

    /**
     * Discount text
     *
     * @return string|\Symfony\Component\Translation\TranslatorInterface
     */
    public function discountText()
    {
        if( $this->type == 'percentage' ) {
            if( $this->shipping_included ) {
                $text = trans('HCECommerceOrders::e_commerce_orders_discount_codes.percentage_discount_with_shipping', ['amount' => $this->amount]);
            } else {
                $text = trans('HCECommerceOrders::e_commerce_orders_discount_codes.percentage_discount_without_shipping', ['amount' => $this->amount]);
            }
        } else if( $this->type == 'fixed' ) {
            if( $this->shipping_included ) {
                $text = trans('HCECommerceOrders::e_commerce_orders_discount_codes.fixed_discount_with_shipping', ['amount' => $this->amount]);
            } else {
                $text = trans('HCECommerceOrders::e_commerce_orders_discount_codes.fixed_discount_without_shipping', ['amount' => $this->amount]);
            }
        } else {
            $text = trans('HCECommerceOrders::e_commerce_orders_discount_codes.none_discount');
        }

        return $text;
    }
}