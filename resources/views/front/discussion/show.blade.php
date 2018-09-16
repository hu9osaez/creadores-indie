@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-fifth">

            </div>
            <div class="column">
                <h2>{{ $discussion->title }}</h2>
            </div>
        </div>
    </div>
</section>
@endsection
