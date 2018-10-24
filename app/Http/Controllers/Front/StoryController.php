<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Models\Story;
use CreadoresIndie\Http\Controllers\Controller;

class StoryController extends Controller
{
    public function show($slug)
    {
        $story = Story::with('user')->whereSlug($slug)->firstOrFail();
        $user = $story->user;

        return view('front.story.show', compact('story', 'user'));
    }
}
