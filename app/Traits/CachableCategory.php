<?php namespace CreadoresIndie\Traits;

use Cache;
use CreadoresIndie\Models\Category;

trait CachableCategory
{
    protected function getCategoryBySlug($slug)
    {
        return Cache::remember("category.{$slug}", 60 * 60 * 12, function () use ($slug) {
            return Category::whereSlug($slug)->first();
        });
    }
}
