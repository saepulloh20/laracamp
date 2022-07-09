@component('mail::message')
    # Your transaction has been confirmed

    Hi, {{ $checkout->User->name }}
    <br>
    Your Transaction has been confirmed, now you can enjoy the benefit of <b>{{ $checkout->Camp->title }}</b>

    @component('mail::button', ['url' => route('user.dashboard')])
        My dashboard
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
