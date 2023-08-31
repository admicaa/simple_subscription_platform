@component('mail::message')
# Welcome To {{ $subscription->domain }}

You Have Subscribed To {{ $subscription->domain }}
If you didn't subscribe you can cancel your subscription here
@component('mail::button', ['url' => route('unsubscribe', ['token' => $subscription->cancel_token])])
    Cancel subscription
@endcomponent
Thanks,<br />
{{ config('app.name') }}
@endcomponent
