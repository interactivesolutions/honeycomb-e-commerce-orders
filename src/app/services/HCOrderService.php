<?php

namespace interactivesolutions\honeycombecommerceorders\app\services;

use Illuminate\Http\Request;
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
        if( $order->order_payment_status_id != $orderPaymentStatusId ) {
            if( $orderPaymentStatusId == 'payment-accepted' ) {
                if( $orderStateId != 'ready-for-processing' && ! is_null($orderStateId) ) {
                    throw new \Exception('Po sėkmingo apmokėjimo užsakymo būsena turi būti nustatyta į paruošta vykdymui');
                }

                $this->paymentAccepted($order, $note);
            }
        } else if( $order->order_payment_status_id == $orderPaymentStatusId ) {

            if( $orderPaymentStatusId == 'payment-accepted' ) {

                if( $order->order_state_id != $orderStateId ) {

                    if( $orderStateId == 'processing-in-progress' ) {
                        if( $order->order_state_id != 'ready-for-processing' ) {
                            throw new \Exception('Tik kai užsakymo būsena buvo ready-for-processing galima pasirinkti processing');
                        }

                        // update order_state to ready for processing
                        $this->processing($order, $note);


                    } else if( $orderStateId == 'shipped' ) {

                        if( $order->order_state_id != 'processing-in-progress' ) {
                            throw new \Exception('Tik kai užsakymo būsena buvo processing-in-progress galima pasirinkti shipping');
                        }

                        // update order_state to shipped
                        $this->shipped($order, $note);


                    } else if( $orderStateId == 'delivered' ) {

                        if( $order->order_state_id != 'shipped' ) {
                            throw new \Exception('Tik kai užsakymo būsena buvo shipped galima pasirinkti delivered');
                        }

                        // update order_state to delivered
                        $this->delivered($order, $note);


                    } else if( $orderStateId == 'canceled' ) {
                        if( $order->order_state_id == 'delivered' ) {
                            throw new \Exception('Pristatytų prekių atšaukti nebegalima');
                        }

                        if( $order->order_state_id == 'shipped' ) {
                            throw new \Exception('Išsiųstų prekių atšaukti nebegalima');
                        }

                        // update order_state to ready for processing
                        $this->canceled($order, $note);
                    }

                }
            }
        }
    }

    /**
     * @param $order
     * @param $note
     */
    protected function paymentAccepted($order, $note)
    {
        // log history
        $this->_logHistory($order->id, 'payment-status', null, 'payment-accepted', $note);

        // update order_state to ready for processing
        $this->readyForProcessing($order, $note);

        $orderDetails = $order->details()->get();

        $stockService = new HCStockService();

        // reduce reserved stock items
        foreach ( $orderDetails as $detail ) {
            $stockService->removeReserved($detail->good_id, $detail->combination_id, $detail->amount, $detail->warehouse_id, $note);
        }

        // TODO call event payment-accepted
    }

    /**
     * @param $order
     * @param $note
     */
    protected function readyForProcessing($order, $note)
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
    protected function processing($order, $note)
    {
        $order->order_state_id = 'processing-in-progress';
        $order->save();


        // TODO call event order processing

        $this->_logHistory($order->id, 'order-state', 'processing-in-progress', null, $note);
    }

    /**
     * @param $order
     * @param $note
     */
    protected function shipped($order, $note)
    {
        $order->order_state_id = 'shipped';
        $order->save();

        // TODO call event order shipped

        $this->_logHistory($order->id, 'order-state', 'shipped', null, $note);
    }

    /**
     * @param $order
     * @param $note
     */
    protected function delivered($order, $note)
    {
        $order->order_state_id = 'delivered';
        $order->save();

        // TODO call event order delivered

        $this->_logHistory($order->id, 'order-state', 'delivered', null, $note);
    }

    /**
     * @param $order
     * @param $note
     */
    protected function canceled($order, $note)
    {
        $order->order_state_id = 'canceled';
        $order->save();

        // TODO return stock information from reserved to on_sale
        // TODO call event order canceled

        $this->_logHistory($order->id, 'order-state', 'canceled', null, $note);
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
}