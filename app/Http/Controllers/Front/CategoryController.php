<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\Discussion;

class CategoryController extends Controller
{
    public function show($category)
    {
        $discussions = Discussion::with(['category', 'user'])
            ->latest('last_reply_at')
            ->whereHas('category', function ($query) use ($category) {
                $query->where('slug', '=', $category);
            })
            ->paginate(10);

        return view('front.category.show', compact('discussions'));
    }
}
