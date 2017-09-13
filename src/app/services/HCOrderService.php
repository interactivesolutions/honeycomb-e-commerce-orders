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
     * @param $orderStateId
     * @param $orderPaymentStatusId
     * @param null $note
     * @throws \Exception
     */
    public function handleUpdate($order, $orderStateId, $orderPaymentStatusId, $note = null)
    {
        if( $order->order_state_id == 'canceled' || $order->order_state_id == 'canceled-and-restored' ) {
            throw new \Exception('Atsakymas atšauktas. Daugiau nieko negalite padaryti.');
        }

        if( $orderStateId == 'canceled' ) {
            // update order_state to canceled
            $this->canceled($order, $note);

            return;
        } else if( $orderStateId == 'canceled-and-restored' ) {
            // update order_state to canceled-and-restored
            $this->canceledAndRestored($order, $note);

            return;
        }

        // when order payment status is changing
        if( $order->order_payment_status_id != $orderPaymentStatusId ) {
            if( $orderPaymentStatusId == 'payment-accepted' ) {
                if( $orderStateId != 'ready-for-processing' && ! is_null($orderStateId) ) {
                    throw new \Exception('Po sėkmingo apmokėjimo užsakymo būsena turi būti nustatyta į paruošta vykdymui');
                }

                $this->paymentAccepted($order, $note);
            }

            // when order payment status not changing but changing order state
        } else if( $order->order_payment_status_id == $orderPaymentStatusId ) {

            // if order is already paid
            if( $orderPaymentStatusId == 'payment-accepted' ) {

                if( $order->order_state_id != $orderStateId ) {

                    if( $orderStateId == 'processing-in-progress' ) {
                        if( $order->order_state_id != 'ready-for-processing' ) {
                            throw new \Exception('Tik kai užsakymo būsena buvo ready-for-processing galima pasirinkti processing');
                        }

                        // update order_state to ready for processing
                        $this->processing($order, $note);

                    } else if( $orderStateId == 'ready-for-shipment' ) {

                        if( $order->order_state_id != 'processing-in-progress' ) {
                            throw new \Exception('Tik kai užsakymo būsena buvo processing-in-progress galima pasirinkti ready-for-shipment');
                        }

                        // update order_state to shipped
                        $this->readyForShipment($order, $note);

                    } else if( $orderStateId == 'shipped' ) {

                        if( $order->order_state_id != 'ready-for-shipment' ) {
                            throw new \Exception('Tik kai užsakymo būsena buvo ready-for-shipment galima pasirinkti shipping');
                        }

                        // update order_state to shipped
                        $this->shipped($order, $note);

                    } else if( $orderStateId == 'delivered' ) {

                        if( $order->order_state_id != 'shipped' ) {
                            throw new \Exception('Tik kai užsakymo būsena buvo shipped galima pasirinkti delivered');
                        }

                        // update order_state to delivered
                        $this->delivered($order, $note);

                    }
//                    else if( $orderStateId == 'canceled' ) {
//                        // update order_state to canceled
//                        $this->canceled($order, $note);
//                    } else if( $orderStateId == 'canceled-and-restored' ) {
//
//                        // update order_state to canceled-and-restored
//                        $this->canceledAndRestored($order, $note);
//                    }
                }
            }
//            else {
//                if( $orderStateId == 'canceled' ) {
//                    // update order_state to canceled
//                    $this->canceled($order, $note);
//                } else if( $orderStateId == 'canceled-and-restored' ) {
//
//                    // update order_state to canceled-and-restored
//                    $this->canceledAndRestored($order, $note);
//                }
//            }
        }
    }

    /**
     * @param $order
     * @param $note
     */
    public function paymentAccepted($order, $note)
    {
        // update order_state to ready for processing
        $this->readyForProcessing($order, $note);

        // log history
        $this->_logHistory($order->id, 'payment-status', null, 'payment-accepted', $note);

        // call event
        event(new HCECOrderPaymentAccepted($order));
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

        if( $order->order_payment_status_id == 'payment-accepted' ) {
            if( in_array($order->order_state_id, ['shipped', 'delivered']) ) {
                // increase stock when items are shipped or delivered
                $this->handleStock($orderDetails, 'replenishmentForSale', $note);

            } else if( $order->order_state_id == 'ready-for-shipment' ) {
                $this->handleStock($orderDetails, 'cancelReadyForShipment', $note);
            } else {
                $this->handleStock($orderDetails, 'removeReserved', $note);
            }
        } else {
            $this->handleStock($orderDetails, 'removeReserved', $note);
        }

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
     * @param $orderStateId
     * @param $orderPaymentStatusId
     * @param $note
     */
    protected function _logHistory($id, $type, $orderStateId, $orderPaymentStatusId, $note)
    {
        HCECOrderHistory::create([
            'order_id'                => $id,
            'type'                    => $type,
            'order_state_id'          => $orderStateId,
            'order_payment_status_id' => $orderPaymentStatusId,
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
            $stockService->{$method}($detail->good_id, $detail->combination_id, $detail->amount, $detail->warehouse_id, $note);
        }
    }
}