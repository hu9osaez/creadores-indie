@extends('layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-fifth">
                @render('sidebarComponent')
            </div>
            <div class="column">
                <ul class="discussions">
                @foreach($discussions as $discussion)
                    <li class="discussion">
                        <a class="discussion__title" href="#">{{ $discussion->title }}</a>
                        <div class="discussion__details">
                            <a href="#" class="discussion__details__category" style="background-color: {{ $discussion['category']['bg_color'] }}; color: {{ $discussion['category']['text_color'] }}">
                                {{ $discussion['category']['name'] }}
                            </a>
                            <span class="discussion__details__user">
                                Por <a href="#">{{ $discussion['user']['name'] }}</a>
                            </span>
                            <span class="dot-separator"></span>
                            <span class="discussion__details__replies">
                                {{ $discussion['replies_count'] }}
                            </span>
                        </div>
                        <p class="discussion__excerpt">{{ $discussion->excerpt }}</p>
                    </li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
