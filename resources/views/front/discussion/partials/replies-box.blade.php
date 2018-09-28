<div class="widget">
    <div class="widget__body">
        <div class="repliesBox">
            @guest
            <div class="repliesBox__guest">
                <p class="has-text-centered">
                    <a href="#auth">
                        Únete a <strong>{{ config('app.name') }}</strong> y participa en este tema
                    </a>
                </p>
            </div>
            @endguest

            @auth
            <div class="repliesBox__form">

                @if(session()->has('message') && session()->pull('is-reply'))
                <div class="message {{ session()->get('message_type') }}">
                    <p class="message-body">{!! session()->pull('message') !!}</p>
                </div>
                @endif

                {{ html()->form('POST', route('front::reply.store', [$category->slug, $discussion->slug]))->open() }}
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <div class="control">
                                {{ html()->textarea('body')->class('textarea')->attribute('rows', 3)->required() }}
                            </div>
                        </div>
                        <div class="field">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    Publicar comentario
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="column is-one-quarter">
                        <div class="repliesBox__form__format">
                            <div class="tag is-dark is-fullwidth">
                                <i class="icon ion-md-color-wand"></i>
                                <span>Formateo de texto</span>
                            </div>
                            <ul>
                                <li><strong>**Negrita**</strong></li>
                                <li><em>*Cursiva*</em></li>
                                <li>Links automaticos</li>
                            </ul>
                        </div>
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
                        <img class="avatar" src="{{ $reply->user->avatar }}">
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
