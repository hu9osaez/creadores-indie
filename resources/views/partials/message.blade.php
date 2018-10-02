@if(session()->has('message'))
<article class="notification {{ session()->get('message_type') }}">
    <p>{!! session()->pull('message') !!}</p>
</article>
@endif
