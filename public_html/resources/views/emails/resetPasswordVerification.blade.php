@component('mail::message')
Email Verification Mail

Please verify your email with bellow link: 

@component('mail::button', ['url' => $url ])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent