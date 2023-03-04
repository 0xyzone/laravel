@component('mail::message')
# You just became a KoverUp Hero!

We are more than happy to welcome you onboard! Lets tell you a **secret!**
We have set the following information as your credential! Yippiee!

@component('mail::panel')
Username: **{{ $username }}** <br>
Password: **{{ $password }}**
@endcomponent


If you wish to login click on the button below!

@component('mail::button', ['url' => 'https://portal.vidantaca.com.np/auth/login'])
    Let me IN!!!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
