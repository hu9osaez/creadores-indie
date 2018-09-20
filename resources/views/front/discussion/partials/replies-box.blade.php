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
                {{ html()->form()->open() }}
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <div class="control">
                                {{ html()->textarea('reply')->class('textarea')->required() }}
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
                                <li>Negrita</li>
                                <li>Italico</li>
                                <li>Subrayada</li>
                                <li>Links automaticos</li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
            @endauth
        </div>
    </div>
</div>
