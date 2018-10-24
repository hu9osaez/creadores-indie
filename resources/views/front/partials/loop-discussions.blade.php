@php($isCategory = isset($category))
<ul class="discussions {{ isset($isStickyDiscussions) ? 'is-sticky' : '' }}">
    @foreach($discussions as $discussion)
    @php($cat = $isCategory ? $category : $discussion->category)
    @php($url = $isCategory ? $discussion->url($cat) : $discussion->url)
    <li class="discussion">
        @if($discussion->sticky && isset($isStickyDiscussions))
        <div class="discussion__sticky">
            <span class="icon">
                <i class="fas fa-thumbtack"></i>
            </span>
        </div>
        @endif
        <div class="discussion__avatar">
            <img src="{{ $discussion->user->avatar_url }}" alt="">
        </div>
        <div class="discussion__content">
            <h2><a class="discussion__title" href="{{ $url }}">{{ $discussion->title }}</a></h2>
            <div class="discussion__details">
                {{ html()->a($cat->url, $cat->name)
                        ->class('discussion__details__category')
                        ->style("background-color: {$cat->bg_color}; color: {$cat->text_color}")
                }}
                <span class="discussion__details__user">
                    Por <a href="{{ $discussion->user->url }}">{{ $discussion->user->name }}</a>
                </span>
                <div class="dot-separator"></div>
                <span class="discussion__details__date">
                    <time title="{{ $discussion->human_date }}">{{ $discussion->relative_date }}</time>
                </span>
                <div class="dot-separator"></div>
                <div class="discussion__details__replies">
                    <span class="icon">
                        <i class="fas fa-comment"></i>
                    </span>
                    <span>{{ $discussion->replies_count }}</span>
                </div>
                <div class="discussion__details__upvotes">
                    <span class="icon">
                        <i class="fas fa-thumbs-up"></i>
                    </span>
                    <span>{{ $discussion->upvotes_count }}</span>
                </div>
            </div>
            @if(!isset($isStickyDiscussions))
            <p class="discussion__excerpt">{{ $discussion->excerpt }}</p>
            @endif
        </div>
    </li>
    @endforeach
</ul>

@if(!isset($isRandomDiscussions) && !isset($isStickyDiscussions))
{{ $discussions->links('partials.pagination-simple') }}
@endif
