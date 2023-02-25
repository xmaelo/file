@component('mail::message')

Hello {{$user->company}}

@component('mail::button', ['url' => route('verify_email',$user->username)])
Verify email
@endcomponent

<p><a href="{{route('verify_email',$user->username)}}">{{route('verify_email',$user->username)}}</a></p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
