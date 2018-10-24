<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Models\Story;
use CreadoresIndie\Http\Controllers\Controller;

class StoryController extends Controller
{
    public function index()
    {
        $stories = Story::with('user')
            ->latest()
            ->paginate();

        return view('front.stories.index',  compact('stories'));
    }

    public function show($slug)
    {
        $story = Story::with('user')->whereSlug($slug)->firstOrFail();
        $user = $story->user;

        return view('front.stories.show', compact('story', 'user'));
    }
}
