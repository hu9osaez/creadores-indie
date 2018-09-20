@extends('layouts.app')

@section('content')
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
