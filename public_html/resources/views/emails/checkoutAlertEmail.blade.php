@component('mail::message')
<b>Thanh toán!</b>

Đơn hàng đã được đặt thành công vào lúc '. {{ $order->created_at }} <br>
Tổng giá tiền: . {{ $order->total_price }}

@component('mail::button', ['url' => url('/') ])
Ghé thăm website
@endcomponent

Cảm ơn đã mua hàng tại shop!<br>
{{ config('app.name') }}
@endcomponent