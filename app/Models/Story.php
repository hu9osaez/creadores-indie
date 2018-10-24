<?php namespace CreadoresIndie\Models;

use Illuminate\Database\Eloquent\Model;
use Markdown;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Story extends Model
{
    use HasSlug;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
