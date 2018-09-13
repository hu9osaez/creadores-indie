<?php namespace CreadoresIndie\Http\ViewComponents;

use CreadoresIndie\Models\Category;
use Illuminate\Contracts\Support\Htmlable;

class SidebarComponent implements Htmlable
{
    public function toHtml() : string
    {
        $categories = Category::orderBy('order')->get();

        return view('front.components.sidebar', compact('categories'));
    }
}
