@extends('layouts.app')

@section('title', $category->name)

@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-fifth-widescreen is-one-quarter-desktop">
                @render('sidebarComponent', ['category' => $category])
            </div>
            <div class="column">
                <div class="category-viewing">
                    <div class="category-viewing__circle" style="background-color: {{ $category->bg_color }}"></div>
                    Explorando los temas en "{{ $category->name }}"
                </div>
                @includeWhen($stickyDiscussions->isNotEmpty(), 'front.partials.loop-discussions', [
                    'category' => $category,
                    'discussions' => $stickyDiscussions,
                    'isStickyDiscussions' => true
                ])
                @include('front.partials.loop-discussions', [
                    'category' => $category,
                    'discussions' => $discussions
                ])
            </div>
        </div>
    </div>
</section>
@endsection
