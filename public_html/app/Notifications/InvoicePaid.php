<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order, $url;

    public function __construct($order, $url)
    {
        $this->order = $order;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        dd('123');
        return (new MailMessage)
                    ->greeting('Thanh toán!')
                    ->line('Đơn hàng đã được đặt thành công vào lúc '. $this->order->created_at)
                    ->line('tổng giá tiền: '. $this->order->total_price)
                    ->action('Ghé thăm website', $this->url)
                    ->line('Cảm ơn đã mua hàng tại shop!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
