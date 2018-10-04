@extends('layouts.app')

@section('title', $discussion->title)

@push('custom-js')
@auth
<script>
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let $btnUpvote = $('#js--btn-upvote');
    let classBtnUpvoted = 'btn-upvote--upvoted';

    $btnUpvote.on('click', function (e) {
        e.preventDefault();

        $.post('{{ route('front::ajax.discussion.upvote', $discussion->encoded_id) }}', function(data) {
            if(data.success) {
                switch (data.code) {
                    case '@discussion/upvote_added':
                        $btnUpvote.addClass(classBtnUpvoted);
                        break;
                    case '@discussion/upvote_removed':
                        $btnUpvote.removeClass(classBtnUpvoted);
                        break;
                }

                $btnUpvote.find('span').html(data.upvotes_count);
            }
        });
    });
});
</script>
@endauth
@endpush

@section('content')
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-one-fifth-widescreen is-one-quarter-desktop is-one-quarter-tablet">
                <div class="widget">
                    <div class="widget__user">
                        <a href="{{ $user->url }}">
                            <img src="{{ $user->avatar_url }}" alt="Perfil de {{ $user->name }}">
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
                            <div class="singleDiscussion__social">
                                <div class="likes">
                                    @php($upvoted = $discussion->isUpvotedBy($loggedInUser))
                                    <button class="button btn-upvote {{ $upvoted ? 'btn-upvote--upvoted' : '' }}" id="js--btn-upvote">
                                        <i class="icon ion-md-thumbs-up"></i>
                                        <span>{{ $discussion->upvotes_count }}</span>
                                    </button>
                                </div>
                                <div class="socialButtons">
                                    <ul>
                                        <li>
                                            <a class="button facebook" href="{{ $discussion->getShareUrl('facebook') }}" target="_blank" rel="noopener" title="Compartir en Facebook">
                                                <i class="icon ion-logo-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="button twitter" href="{{ $discussion->getShareUrl('twitter') }}" target="_blank" rel="noopener" title="Compartir en Twitter">
                                                <i class="icon ion-logo-twitter"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
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
