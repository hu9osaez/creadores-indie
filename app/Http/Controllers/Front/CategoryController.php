<?php namespace CreadoresIndie\Http\Controllers\Front;

use CreadoresIndie\Http\Controllers\Controller;
use CreadoresIndie\Traits\CachableCategory;

class CategoryController extends Controller
{
    use CachableCategory;

    public function show($category)
    {
        $categorySlug = $category;

        /** @var \CreadoresIndie\Models\Category $category */
        $category = $this->getCategoryBySlug($categorySlug);
        $discussions = $category->discussions()->noSticky()
            ->with('user')
            ->latest()
            ->paginate();

        $stickyDiscussions = $category->discussions()->sticky()
            ->with('user')
            ->latest()
            ->get();

        return view('front.category.show', compact('category', 'discussions', 'stickyDiscussions'));
    }
}
