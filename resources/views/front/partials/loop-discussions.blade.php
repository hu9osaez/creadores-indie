<ul class="discussions">
    @foreach($discussions as $discussion)
    <li class="discussion">
        <div class="discussion__avatar">
            <img src="https://devdojo.com/media/users/default.png" >
        </div>
        <div class="discussion__content">
            <a class="discussion__title" href="{{ $discussion->url }}">{{ $discussion->title }}</a>
            <div class="discussion__details">
                {{ $discussion->category->el }}
                <span class="discussion__details__user">
                    Por <a href="{{ $discussion->user->url }}">{{ $discussion->user->name }}</a>
                </span>
                <div class="dot-separator"></div>
                <span class="discussion__details__date">
                    <time title="{{ $discussion['human_date'] }}">{{ $discussion['relative_date'] }}</time>
                </span>
                <div class="dot-separator"></div>
                <span class="discussion__details__replies">
                    <i class="icon is-small ion-md-chatbubbles"></i>
                    {{ $discussion['replies_count'] }}
                </span>
            </div>
            <p class="discussion__excerpt">{{ $discussion->excerpt }}</p>
        </div>
    </li>
    @endforeach
</ul>

{{ $discussions->links('partials.pagination-simple') }}
