<footer>
    <div class="container">
        <div class="columns">
            <div class="column">
                <p class="copyright">
                    &copy; {{ now()->year }} <strong>{{ config('app.name') }}</strong> por
                    <a href="https://twitter.com/hu9osaez" target="_blank">@hu9osaez</a>
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
                            <i class="icon ion-logo-twitter"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
