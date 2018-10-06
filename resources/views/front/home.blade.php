@extends('layouts.app')

@section('content')
<section class="topHome" id="section-top-home">
    <div class="container">
        <p class="subtitle has-text-centered">
            Conecta, comparte y aprende de otros <strong>{{ strtolower(config('app.name')) }}</strong>
            que tienen sus negocios y proyectos en el mundo digital.
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-fifth-widescreen is-one-quarter-desktop">
                @render('sidebarComponent')
            </div>
            <div class="column">
                <div class="category-viewing">Explorando todos los temas</div>
                @include('front.partials.loop-discussions')
            </div>
        </div>
    </div>
</section>
@endsection
