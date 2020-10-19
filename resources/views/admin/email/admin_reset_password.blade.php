@component('mail::message')
#Reset password

Dear {!! $data['data']->name !!},
please click button to reset your password
@component('mail::button', ['url' => aurl('reset/password/'.$data['token'])])
    click here to reset password
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent

