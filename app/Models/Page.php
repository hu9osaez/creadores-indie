<?php namespace CreadoresIndie\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Markdown;
use Moloquent;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Page extends Moloquent
{
    use HasSlug, SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $fillable = [
        'title',
        'content',
        'slug'
    ];

    public function getParsedContentAttribute()
    {
        return Markdown::convertToHtml($this->content);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
