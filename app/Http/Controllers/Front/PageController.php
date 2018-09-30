<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Models\Page;

class PageController extends Controller
{
    public function show($slug)
    {
        $page = Page::whereSlug($slug)->firstOrFail();

        return view('front.page.show', compact('page'));
    }
}
