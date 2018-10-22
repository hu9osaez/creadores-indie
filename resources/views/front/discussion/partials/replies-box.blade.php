@push('custom-css')
<link href="{{ asset('3rdparty/trumbowyg/ui/trumbowyg.min.css') }}" rel="stylesheet" />
@endpush

@push('custom-js')
<script src="{{ asset('3rdparty/trumbowyg/trumbowyg.min.js') }}"></script>
<script src="{{ asset('3rdparty/trumbowyg/trumbowyg.es.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#editor').trumbowyg({
            lang: 'es',
            autogrow: true,
            minimalLinks: true,
            removeformatPasted: true,
            resetCss: true,
            semantic: true,
            btns: [
                ['strong', 'em', 'underline', 'del'],
                ['blockquote'],
                ['unorderedList', 'orderedList'],
                ['link', 'insertImage']
            ]
        });
    });
</script>
@endpush

<div class="widget">
    <div class="widget__body">
        <div class="repliesBox">
            @guest
            <div class="repliesBox__guest">
                <p class="has-text-centered">
                    <a href="{{ route('login') }}">
                        Únete a <strong>{{ config('app.name') }}</strong> y participa en este tema
                    </a>
                </p>
            </div>
            @endguest

            @auth
            <div class="repliesBox__form">

                <p class="subtitle is-5">Dejar un comentario</p>

                @if(session()->has('message') && session()->pull('is-reply'))
                <div class="message {{ session()->get('message_type') }}">
                    <p class="message-body">{!! session()->pull('message') !!}</p>
                </div>
                @endif

                {{ html()->form('POST', route('front::reply.store', [$category->slug, $discussion->slug]))->open() }}
                <div class="field">
                    <div class="control">
                        {{ html()->textarea('body')->class('textarea')->id('editor')->required() }}
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button type="submit" class="button is-primary is-outlined">Publicar</button>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
            @endauth


            @if($replies->isNotEmpty())
            <div class="repliesBox__list">
                @foreach($replies as $reply)
                <div class="media">
                    <figure class="media-left">
                        <img class="avatar" src="{{ $reply->user->avatar_url }}">
                    </figure>
                    <div class="media-content">
                        <p>
                            <a href="{{ $reply->user->url }}">
                                <strong>{{ $reply->user->name }}</strong> <small>{{ $reply->user->username_public }}</small>
                            </a>
                        </p>
                        <div class="content">
                            {!! $reply->parsed_body !!}
                        </div>
                    </div>
                    <div class="media-right">
                        <small class="has-text-grey">{{ $reply->relative_date }}</small>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
