<?php

namespace interactivesolutions\honeycombecommerceorders\app\services;

use Illuminate\Http\Request;
use interactivesolutions\honeycombecommerceorders\app\events\{
    HCECOrderCanceled, HCECOrderCanceledAndRestored, HCECOrderDelivered, HCECOrderPaymentAccepted, HCECOrderProcessing, HCECOrderReadyForShipment, HCECOrderShipped
};
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\orders\HCECOrderHistory;
use interactivesolutions\honeycombecommercewarehouse\app\services\HCStockService;

class HCOrderService
{
    /**
     * @param $order
     * @param $newOrderStateId
     * @param $newOrderPaymentStatusId
     * @param null $note
     * @throws \Exception
     */
    public function handleUpdate($order, $newOrderStateId, $newOrderPaymentStatusId, $note = null)
    {
        if( $order->order_state_id == 'canceled' || $order->order_state_id == 'canceled-and-restored' ) {
            throw new \Exception(trans('HCECommerceOrders::e_commerce_orders.errors.order_canceled'));
        }

        if( $newOrderStateId == 'canceled' ) {
            // update order_state to canceled
            $this->canceled($order, $note);

            return;
        } else if( $newOrderStateId == 'canceled-and-restored' ) {
            // update order_state to canceled-and-restored
            $this->canceledAndRestored($order, $note);

            return;
        }

        if( $order->order_state_id == 'waiting-for-stock' ) {
            throw new \Exception(trans('HCECommerceOrders::e_commerce_orders.errors.waiting_for_stock_only_cancel'));
        }

        // when order payment status is changing
        if( $order->order_payment_status_id != $newOrderPaymentStatusId ) {
            if( $newOrderPaymentStatusId == 'payment-accepted' ) {
                if( $newOrderStateId != 'ready-for-processing' && ! is_null($newOrderStateId) ) {
                    throw new \Exception(trans('HCECommerceOrders::e_commerce_orders.errors.payment_accepted_but_not_ready'));
                }

                $this->paymentAccepted($order, $note);
            }

            // when order payment status not changing but changing order state
        } else if( $order->order_payment_status_id == $newOrderPaymentStatusId ) {

            // if order is already paid
            if( $newOrderPaymentStatusId == 'payment-accepted' ) {

                if( $order->order_state_id != $newOrderStateId ) {

                    if( $newOrderStateId == 'processing-in-progress' ) {
                        if( $order->order_state_id != 'ready-for-processing' ) {
                            throw new \Exception(trans('HCECommerceOrders::e_commerce_orders.errors.not_ready_for_processing'));
                        }

                        // update order_state to ready for processing
                        $this->processing($order, $note);

                    } else if( $newOrderStateId == 'ready-for-shipment' ) {

                        if( $order->order_state_id != 'processing-in-progress' ) {
                            throw new \Exception(trans('HCECommerceOrders::e_commerce_orders.errors.not_ready_for_shipment_after_processing'));
                        }

                        // update order_state to shipped
                        $this->readyForShipment($order, $note);

                    } else if( $newOrderStateId == 'shipped' ) {

                        if( $order->order_state_id != 'ready-for-shipment' ) {
                            throw new \Exception(trans('HCECommerceOrders::e_commerce_orders.errors.not_ready_for_shipment'));
                        }

                        // update order_state to shipped
                        $this->shipped($order, $note);

                    } else if( $newOrderStateId == 'delivered' ) {

                        if( $order->order_state_id != 'shipped' ) {
                            throw new \Exception(trans('HCECommerceOrders::e_commerce_orders.errors.not_ready_for_delivered'));

                        }

                        // update order_state to delivered
                        $this->delivered($order, $note);

                    }
                }
            }
        }
    }

    /**
     * @param $order
     * @param $note
     */
    public function paymentAccepted($order, $note)
    {
        $order->load('details');

        if( $order->details->contains('is_pre_ordered', '1') ) {
            // update order_state to waiting for stock
            $this->waitingForStock($order, $note);
        } else {
            // update order_state to ready for processing
            $this->readyForProcessing($order, $note);
        }

        // log history
        $this->_logHistory($order->id, 'payment-status', null, 'payment-accepted', $note);

        // call event
        event(new HCECOrderPaymentAccepted($order));
    }

    /**
     * Waiting for stock
     *
     * @param $order
     * @param $note
     */
    public function waitingForStock($order, $note)
    {
        $order->order_payment_status_id = 'payment-accepted';
        $order->order_state_id = 'waiting-for-stock';
        $order->save();

        $this->_logHistory($order->id, 'order-state', 'waiting-for-stock', null, $note);
    }

    /**
     * @param $order
     * @param $note
     */
    public function readyForProcessing($order, $note)
    {
        $order->order_payment_status_id = 'payment-accepted';
        $order->order_state_id = 'ready-for-processing';
        $order->save();

        $this->_logHistory($order->id, 'order-state', 'ready-for-processing', null, $note);
    }

    /**
     * @param $order
     * @param $note
     */
    public function processing($order, $note)
    {
        $order->order_state_id = 'processing-in-progress';
        $order->save();

        $this->_logHistory($order->id, 'order-state', 'processing-in-progress', null, $note);

        // call event
        event(new HCECOrderProcessing($order));
    }

    /**
     * @param $order
     * @param $note
     */
    public function readyForShipment($order, $note)
    {
        $this->handleStock($order->details()->get(), 'moveToReadyForShipment', $note);

        $order->order_state_id = 'ready-for-shipment';
        $order->save();

        // log history
        $this->_logHistory($order->id, 'order-state', 'ready-for-shipment', null, $note);

        // call event
        event(new HCECOrderReadyForShipment($order));
    }

    /**
     * @param $order
     * @param $note
     */
    public function shipped($order, $note)
    {
        $this->handleStock($order->details()->get(), 'removeReadyForShipment', $note);

        $order->order_state_id = 'shipped';
        $order->save();

        $this->_logHistory($order->id, 'order-state', 'shipped', null, $note);

        // call event
        event(new HCECOrderShipped($order));
    }

    /**
     * @param $order
     * @param $note
     */
    public function delivered($order, $note)
    {
        $order->order_state_id = 'delivered';
        $order->save();

        $this->_logHistory($order->id, 'order-state', 'delivered', null, $note);

        // call event
        event(new HCECOrderDelivered($order));
    }

    /**
     * @param $order
     * @param $note
     */
    public function canceled($order, $note)
    {
        if( in_array($order->order_state_id, ['canceled', 'canceled-and-restored']) ) {
            return;
        }

        $order->order_state_id = 'canceled';
        $order->save();

        $this->_logHistory($order->id, 'order-state', 'canceled', null, $note);

        // call event
        event(new HCECOrderCanceled($order));
    }

    /**
     * @param $order
     * @param $note
     */
    public function canceledAndRestored($order, $note)
    {
        $orderDetails = $order->details()->get();

        if( in_array($order->order_state_id, ['canceled', 'canceled-and-restored']) ) {
            return;
        }

        $method = $this->getStockMethod($order);

        // restore stock by order status
        $this->handleStock($orderDetails, $method, $note);

        $order->order_state_id = 'canceled-and-restored';
        $order->save();

        $this->_logHistory($order->id, 'order-state', 'canceled-and-restored', null, $note);

        // call event
        event(new HCECOrderCanceledAndRestored($order));
    }

    /**
     * Log history
     *
     * @param $id
     * @param $type
     * @param $newOrderStateId
     * @param $newOrderPaymentStatusId
     * @param $note
     */
    protected function _logHistory($id, $type, $newOrderStateId, $newOrderPaymentStatusId, $note)
    {
        HCECOrderHistory::create([
            'order_id'                => $id,
            'type'                    => $type,
            'order_state_id'          => $newOrderStateId,
            'order_payment_status_id' => $newOrderPaymentStatusId,
            'note'                    => $note,
        ]);
    }

    /**
     * Handle stock
     *
     * @param $details
     * @param $method
     * @param $note
     */
    protected function handleStock($details, $method, $note)
    {
        $stockService = new HCStockService();

        foreach ( $details as $detail ) {
            if( $method == 'cancelReserved' && $detail->is_reserved_for_pre_order ) {
                $stockService->removePreOrdered($detail->good_id, $detail->combination_id, $detail->amount, $detail->warehouse_id, $note);
            } else {
                $stockService->{$method}($detail->good_id, $detail->combination_id, $detail->amount, $detail->warehouse_id, $note);
            }
        }
    }

    /**
     * @param $order
     * @return string
     */
    protected function getStockMethod($order): string
    {
        $method = 'cancelReserved';

        if( $order->order_payment_status_id == 'payment-accepted' ) {
            if( in_array($order->order_state_id, ['shipped', 'delivered']) ) {
                $method = 'replenishmentForSale';
            } else if( $order->order_state_id == 'ready-for-shipment' ) {
                $method = 'cancelReadyForShipment';
            }
        }

        return $method;
    }
}