@component('mail::message', ['subcopy' => 'If you ever have any comments or questions, feel free to contact us by replying to this email'])
# Welcome to {{ config('app.name') }}

Thanks for registering {{ $user->username }}!

You are a **{{ $user->role->name }}** user.

@component('mail::button', ['url' => route('login')])
    View Profile / Get API Key
@endcomponent


@endcomponent
