@component('mail::message')

@slot('header')
Welcome to FDC!
@endslot


# Hello {{$user->first_name}}!

{!! $message ?? '' !!}

@if(is_array($button))
@component('mail::button', ['url'=> $button['link'] ])
{{$button['title']}}
@endcomponent
@endif

Welcome!<br>
The FDC Team

@component('mail::subcopy')
<a href="https://faithdrivenconsumer.com" target="_blank"><img width="200" height="52" src="https://faithdrivenconsumer.com/members/assets/img/fdcemailsig.png" alt="Faith Driven Consumer"/></a>
@endcomponent

@endcomponent
