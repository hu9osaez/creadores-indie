<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\Discussion;

class DiscussionController extends Controller
{
    public function show($category, $slug)
    {
        $discussion = Discussion::with(['category', 'user', 'replies.user'])
            ->whereHas('category', function ($query) use ($category) {
                $query->where('slug', '=', $category);
            })
            ->whereSlug($slug)
            ->firstOrFail();

        $category = $discussion->category;
        $user = $discussion->user;
        $replies = $discussion->replies->sortByDesc('created_at');

        return view('front.discussion.show', compact('category', 'discussion', 'user', 'replies'));
    }
}
