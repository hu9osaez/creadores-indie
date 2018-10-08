<ul class="discussions">
    @foreach($discussions as $discussion)
    <li class="discussion">
        <div class="discussion__avatar">
            <img src="{{ $discussion->user->avatar_url }}" >
        </div>
        <div class="discussion__content">
            <a class="discussion__title" href="{{ $discussion->url }}">{{ $discussion->title }}</a>
            <div class="discussion__details">
                {{ html()->a(route('front::category.show', $discussion->category->slug), $discussion->category->name)
                        ->class('discussion__details__category')
                        ->style("background-color: {$discussion->category->bg_color}; color: {$discussion->category->text_color}")
                }}
                <span class="discussion__details__user">
                    Por <a href="{{ $discussion->user->url }}">{{ $discussion->user->name }}</a>
                </span>
                <div class="dot-separator"></div>
                <span class="discussion__details__date">
                    <time title="{{ $discussion['human_date'] }}">{{ $discussion['relative_date'] }}</time>
                </span>
                <div class="dot-separator"></div>
                <div class="discussion__details__replies">
                    <i class="icon is-small ion-md-chatbubbles"></i>
                    <span>{{ $discussion->replies_count }}</span>
                </div>
                <div class="discussion__details__upvotes">
                    <i class="icon is-small ion-md-thumbs-up"></i>
                    <span>{{ $discussion->upvotes_count }}</span>
                </div>
            </div>
            <p class="discussion__excerpt">{{ $discussion->excerpt }}</p>
        </div>
    </li>
    @endforeach
</ul>

@if(!isset($isRandomDiscussions))
{{ $discussions->links('partials.pagination-simple') }}
@endif
