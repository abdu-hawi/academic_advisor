@component('mail::message')
# Advisor Reset Password

Click button below to redirect to reset password page.

@component('mail::button',  ['url' => advisorURL('reset/password/'.$data['token']) ] )
    Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
