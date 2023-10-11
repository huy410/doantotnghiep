<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class NotificationOrder implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $productName;
    public $timeBuyProduct;
    public $productLink;
    public $productImage;
    
    public function __construct($productName, $timeBuyProduct, $productLink, $productImage)
    {
        $this->productName = $productName;
        $this->timeBuyProduct = $timeBuyProduct;
        $this->productLink = $productLink;
        $image = explode('|', $productImage);
        $this->productImage = asset("uploads/$image[0]");
        
    }

    public function broadcastOn()
    {
        return new Channel('EventTriggered');
    }
}
