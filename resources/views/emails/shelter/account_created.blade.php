@component('mail::message')
# Welcome to PawPal, {{ $user->name }}

An account has been created for you as shelter staff.

Below are your login details — please keep them secure.

@component('mail::panel')
**Email:** {{ $user->email }}  
**Password:** {{ $password }}
@endcomponent

You can log in here: @component('mail::button', ['url' => config('app.url') . '/admin/login'])
Log in
@endcomponent

For security, we recommend changing your password after your first login (Admin → Settings → Password).

Thanks,<br>
**The PawPal Team**
@endcomponent
