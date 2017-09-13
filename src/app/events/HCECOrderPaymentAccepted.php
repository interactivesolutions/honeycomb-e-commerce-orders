<?php

namespace interactivesolutions\honeycombecommerceorders\app\events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use interactivesolutions\honeycombecommerceorders\app\models\ecommerce\HCECOrders;

class HCECOrderPaymentAccepted
{
    use SerializesModels;

    /**
     * @var HCECOrders
     */
    public $order;

    /**
     * Create a new event instance.
     *
     * @param HCECOrders $order
     */
    public function __construct(HCECOrders $order)
    {
        $this->order = $order;
    }
}
