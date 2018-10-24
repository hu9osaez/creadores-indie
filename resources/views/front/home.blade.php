@extends('layouts.app')

@section('content')
<section class="section section--is-top">
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
                @if(isset($isSearch) && $isSearch)
                <div class="category-viewing">Resultados de búsqueda</div>
                @else
                <div class="category-viewing">Explorando todos los temas</div>
                @endif

                @if(isset($isSearch) && $isSearch && $discussions->isEmpty())
                <div class="widget">
                    <div class="widget__body">
                        <p class="has-text-centered">No hay resultados para tu búsqueda.</p>
                    </div>
                </div>
                @endif

                @includeWhen($discussions->isNotEmpty(), 'front.partials.loop-discussions')
            </div>
        </div>
    </div>
</section>
@endsection
