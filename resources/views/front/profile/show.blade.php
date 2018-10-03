@extends('layouts.app')

@section('title', $user->name)

@section('content')
<section class="section">
    <div class="container">
        <div class="userProfile">
            <div class="columns">
                <div class="column is-one-quarter">
                    <div class="widget">
                        <div class="widget__body">
                            <div class="userProfile__details">
                                <div class="userProfile__details__avatar">
                                    <img src="{{ $user->avatar_url }}">
                                </div>
                                <div class="userProfile__details__metadata">
                                    <div class="userProfile__details__metadata__name">{{ $user->name }}</div>
                                    <div class="userProfile__details__metadata__username">{{ $user->username_public }}</div>
                                    <div class="userProfile__details__divider"></div>
                                    @if(!is_null($user->bio))
                                    <div class="userProfile__details__metadata__bio">{{ $user->bio }}</div>
                                    <div class="userProfile__details__divider"></div>
                                    @endif
                                    <div class="userProfile__details__metadata__joined">
                                        <strong>Registro:</strong>
                                        <span>{{ $user->created_at->format('d M, Y') }}</span>
                                    </div>
                                    <div class="userProfile__details__metadata__discussions">
                                        <strong>Temas creados:</strong>
                                        <span>{{ $user->discussions_count }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                @if($discussions->isNotEmpty())
                    <div class="category-viewing">Temas iniciados por {{ $user->name }}</div>
                    @include('front.partials.loop-discussions', ['discussions' => $discussions])
                @else
                    <div class="userProfile__noPosts">
                        <div class="userProfile__noPosts__heading">
                            @if($loggedInUser && $loggedInUser->id === $user->id)
                            <span>Aún no has creado ningún tema.</span>
                            @else
                            <span><u>{{ $user->name }}</u> aún no a creado ningún tema.</span>
                            @endif
                        </div>
                    </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
