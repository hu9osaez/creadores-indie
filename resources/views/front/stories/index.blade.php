@extends('layouts.app')

@section('title', 'Historias')

@section('content')
<section class="section section--is-top">
    <div class="container">
        <p class="subtitle is-4 has-text-centered">
            Descubre historias de quienes han logrado éxito o fracasado y aprendido de ello <br />
            en el mundo de los negocios digitales.
        </p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-four-fifths">
                <div class="stories">
                @foreach($stories as $story)
                <div class="widget widget--story">
                    <div class="widget__body">
                        <a class="story" href="{{ $story->url }}">
                            <div class="story__avatar">
                                <img src="{{ $story->user->avatar_url }}" alt="Avatar de {{ $story->user->name }}">
                            </div>
                            <div class="story__content">
                                <h2 class="story-title">{{ $story->title }}</h2>
                                <div class="extra">
                                    <div class="user">
                                        <span>{{ $story->user->name }} ({{$story->user->username_public}})</span>
                                    </div>
                                    @if($story->mrr)
                                    <div class="mrr">
                                        <strong title="Ingreso mensual recurrente">MRR:</strong>
                                        <span>{{ $story->mrr }}</span>
                                    </div>
                                    @endif
                                    <div class="start-date">
                                        <strong>Fecha inicio:</strong>
                                        <span>{{ $story->human_date }}</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
