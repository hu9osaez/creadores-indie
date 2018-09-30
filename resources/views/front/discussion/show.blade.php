@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-fifth-widescreen is-one-quarter-desktop is-one-quarter-tablet">
                <div class="widget">
                    <div class="widget__user">
                        <a href="{{ $user->url }}">
                            <img src="{{ $user->avatar }}" alt="Perfil de {{ $user->name }}">
                            <div class="content">
                                <span class="name">{{ $user->name }}</span>
                                <span class="username">{{ $user->username }}</span>
                            </div>
                        </a>
                        <div class="details">
                            <div class="joined">
                                <strong>Registro:</strong>
                                <span>{{ $user->created_at->format('d M, Y') }}</span>
                            </div>
                            <div class="posts">
                                <strong>Temas creados:</strong>
                                <span>{{ $user->discussions_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column">
                <div class="widget">
                    <div class="widget__body">
                        <div class="singleDiscussion">
                            <div class="singleDiscussion__head">
                                <div class="singleDiscussion__head__category">
                                    <span>Publicado en</span>
                                    {{ html()->a(route('front::category.show', $category->slug), $category->name)
                                        ->style("background-color: {$category->bg_color}; color: {$category->text_color}")
                                    }}
                                </div>
                                <div class="singleDiscussion__head__date">
                                    <span>{{ $discussion->human_date_alt }}</span>
                                </div>
                            </div>
                            <h2 class="singleDiscussion__title">{{ $discussion->title }}</h2>
                            <div class="singleDiscussion__content content">
                                {!! $discussion->parsed_body !!}
                            </div>
                        </div>
                    </div>
                </div>
                @include('front.discussion.partials.replies-box')
            </div>
        </div>
    </div>
</section>
@endsection
