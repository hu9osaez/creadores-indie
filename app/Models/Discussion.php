<?php namespace CreadoresIndie\Models;

use CreadoresIndie\Traits\Shareable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Markdown;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Discussion extends Model
{
    use HasSlug, Shareable, SoftDeletes;

    protected $appends = [
        'excerpt',
        'url'
    ];

    protected $dates = [
        'deleted_at',
        'last_reply_at'
    ];

    protected $shareOptions = [
        'columns' => [
            'title' => 'title'
        ],
        'url' => 'url'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /** Custom attributes */

    public function getExcerptAttribute()
    {
        return Str::words($this->body, 20);
    }

    public function getHumanDateAttribute()
    {
        return $this->created_at->format('d-m-Y H:i');
    }

    public function getHumanDateAltAttribute()
    {
        return $this->created_at->format('d M, Y');
    }

    public function getParsedBodyAttribute()
    {
        return Markdown::convertToHtml($this->body);
    }

    public function getRelativeDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getUrlAttribute()
    {
        return route('front::discussion.show', [$this->category->slug, $this->slug]);
    }

    /** Relations **/
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'id_discussion');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
