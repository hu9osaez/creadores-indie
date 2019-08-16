<?php namespace CreadoresIndie\Models;

use Jenssegers\Date\Date;
use Markdown;
use Moloquent;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Story extends Moloquent
{
    use HasSlug;

    protected $casts = [
        'start_date' => 'date'
    ];

    protected $fillable = [
        'title',
        'content',
        'slug'
    ];

    protected $perPage = 10;

    public function getParsedContentAttribute()
    {
        return Markdown::convertToHtml($this->content);
    }

    public function getHumanDateAttribute()
    {
        return ucfirst((new Date($this->start_date))->format('F, Y'));
    }

    public function getUrlAttribute()
    {
        return route('front::stories.show', $this->slug);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
