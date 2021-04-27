@component('mail::message')
# Introduction

We heard that you lost your GitHub password. Sorry about that!

But don’t worry! You can use the following button to reset your password:


@component('mail::button', ['url' => $url])
Resetear contraseña
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
