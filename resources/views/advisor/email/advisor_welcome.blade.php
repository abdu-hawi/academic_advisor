@component('mail::message')
# Welcome

Click button below to redirect to verify your account.

@component('mail::button', ['url' => advisorURL('verify/'.$data['token']) ] )
Verify Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
