@extends('layouts.app')

@section('title', $page->title)

@section('content')
<section class="section">
    <div class="container">
        <div class="columns is-centered">
            <div class="column is-four-fifths">
                <div class="widget">
                    <div class="widget__body">
                        <h3 class="title is-3">{{ $page->title }}</h3>
                        <div class="content">
                            {!! $page->parsed_content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
