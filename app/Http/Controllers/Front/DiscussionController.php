<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\Discussion;

class DiscussionController extends Controller
{
    public function show($category, $slug)
    {
        $discussion = Discussion::with(['category', 'user'])
            ->whereHas('category', function ($query) use ($category) {
                $query->where('slug', '=', $category);
            })
            ->whereSlug($slug)
            ->firstOrFail();

        return view('front.discussion.show', compact('discussion'));
    }
}
