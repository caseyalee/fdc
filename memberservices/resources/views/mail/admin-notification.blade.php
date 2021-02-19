@component('mail::message')

    @slot('header')
        Admin Notification
    @endslot

The following event was logged:

{!! $message ?? '' !!}

Regards,<br>
🤖

@component('mail::subcopy')
    <a href="https://faithdrivenconsumer.com" target="_blank"><img width="200" height="52" src="https://faithdrivenconsumer.com/members/assets/img/fdcemailsig.png" alt="Faith Driven Consumer"/></a>
@endcomponent

@endcomponent
