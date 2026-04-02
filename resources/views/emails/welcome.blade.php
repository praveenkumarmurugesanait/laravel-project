@component('mail::message')
# Hello!

{{ $bodyText }}

@component('mail::button', ['url' => 'https://yourapp.com/login'])
Login Now
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
