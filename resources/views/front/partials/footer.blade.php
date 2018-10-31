<div class="feedback-box">
    <div class="feedback-box__title">
        <span>¿Tienes algún comentario?</span>
        <span class="icon fa fa-chevron-down"></span>
    </div>
    <div class="feedback-box__body">
        <div id="feedback-form">
            <p class="has-text-dark is-size-7">
                Hazme saber si tienes un problema o una sugerencia sobre {{ config('app.name') }}.
            </p>
            <div class="field">
                <div class="control">
                    {{ html()->text('name')->class('input is-small')->placeholder('Nombre')->required() }}
                </div>
            </div>
            <div class="field">
                <div class="control">
                    {{ html()->email('email')->class('input is-small')->placeholder('Correo electrónico')->required() }}
                </div>
            </div>
            <div class="field">
                <div class="control">
                    {{ html()->textarea('message')->class('textarea is-small')->placeholder('Mensaje')->required() }}
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button class="button is-outlined is-small is-primary" type="button">Enviar</button>
                </div>
            </div>
        </div>
        <p id="success"></p>
    </div>
</div>

<footer>
    <div class="container">
        <div class="columns">
            <div class="column">
                <p class="copyright">
                    &copy; {{ now()->year }} <strong>{{ config('app.name') }}</strong> por
                    <a href="https://twitter.com/hu9osaez" target="_blank">@hu9osaez</a>
                    <span class="dot-separator"></span>
                    <a href="https://github.com/hu9osaez/creadores-indie" target="_blank">
                        Open source <span class="heart">❤</span>
                    </a>
                </p>
            </div>
            <div class="column">
                <ul class="links">
                    <li>
                        <a href="{{ route('front::page.show', 'privacy') }}">Política de privacidad</a>
                    </li>
                    <li class="dot-separator"></li>
                    <li>
                        <a href="https://twitter.com/CreadoresIndie" target="_blank">
                            <span class="icon">
                                <i class="fab fa-twitter"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
