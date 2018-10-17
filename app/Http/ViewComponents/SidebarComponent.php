<?php namespace CreadoresIndie\Http\ViewComponents;

use Cache;
use CreadoresIndie\Models\Category;
use Illuminate\Contracts\Support\Htmlable;

class SidebarComponent implements Htmlable
{
    /** @var \CreadoresIndie\Models\Category|null */
    private $category;

    public function __construct($category = null)
    {
        $this->category = $category;
    }

    public function toHtml() : string
    {
        $actualCategory = $this->category;
        $categories = Cache::remember('sidebar.categories', 7200, function () {
            return Category::orderBy('order')->get();
        });

        return view('front.components.sidebar', compact('actualCategory', 'categories'));
    }
}
