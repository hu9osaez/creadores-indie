<?php namespace CreadoresIndie\Http\ViewComponents;

use Illuminate\Contracts\Support\Htmlable;

class RandomDiscussionsComponent implements Htmlable
{
    /** @var \CreadoresIndie\Models\Category */
    private $category;

    /** @var int */
    private $limit;

    public function __construct($category, $limit = 3)
    {
        $this->category = $category;
        $this->limit = $limit;
    }

    public function toHtml() : string
    {
        $category = $this->category;

        $discussions = $category->discussions()
            ->with('category', 'user')
            ->inRandomOrder()
            ->limit($this->limit)
            ->get();

        return view('front.components.random-discussion', compact('category', 'discussions'));
    }
}
