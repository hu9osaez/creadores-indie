<?php namespace CreadoresIndie\Models;

use Moloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Category extends Moloquent
{
    use HasSlug, SoftDeletes;

    protected $casts = [
        'bg_color' => 'string',
        'text_color' => 'string'
    ];

    protected $fillable = [
        'order',
        'name',
        'color',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getBgColorAttribute()
    {
        return $this->color;
    }

    public function getTextColorAttribute()
    {
        return getContrastColor($this->color);
    }

    public function getUrlAttribute()
    {
        return route('front::category.show', $this->slug);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'id_category');
    }
}
