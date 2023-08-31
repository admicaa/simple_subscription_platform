@component('mail::message')
# New Post Has been published
# {{ $post->website->domain }} has published new post
{{ $post->title }}
@if ($post->body)
@component('mail::panel')
{{ Str::limit($post->body,350,'...') }}
@endcomponent
@endif
@if ($post->link)
@component('mail::button', ['url' => $post->link])
See Post
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
