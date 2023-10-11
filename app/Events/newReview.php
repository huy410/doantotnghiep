<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class newReview implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $customerName;
    public $title;
    public $total_star;
    public $productName;
    public $timeReview;

    public function __construct($event)
    {
        $this->customerName = $event->customer->name;
        $oldDate = strtotime($event->created_at);
        $this->timeReview = date('Y-m-d H:i:s',$oldDate);
        $this->total_star = $event->total_star;
        $this->title = $event->title;
        $this->productName = $event->product->name;
        $this->idNewReview =  route('reviews.show', $event->id);
    }

    public function broadcastOn()
    {
        return new channel('ReviewEvent');
    }
}
