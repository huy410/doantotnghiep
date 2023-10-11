<?php

namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class newOrder implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customerNewOrder;
    public $dateNewOrder;
    public $priceNewOrder;
    public $idNewOrder;
    public $paymentStatus;
    public $shipStatus;
    public $paymentMethod;
    public $buttonPayment;
    public $buttonDelivery;

    public function __construct($order)
    {
        $this->customerNewOrder = $order->customer->name;
        $this->paymentStatus = $order->payment_status;
        $this->buttonPayment = route('orders.payment', $order->id);
        $this->buttonDelivery =route('orders.delivery', $order->id);
        $this->shipStatus = $order->ship_status;
        $this->paymentMethod = $order->payment_method;
        $oldDate = strtotime($order->created_at);
        $this->dateNewOrder = date('Y-m-d H:i:s',$oldDate);
        $this->priceNewOrder = number_format($order->total_price);
        $this->idNewOrder =  route('orders.show', $order->id);

    }

    public function broadcastOn()
    {
        return new Channel('OrderEvent');
    }
}
