<?php namespace CreadoresIndie\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Discussion extends Model
{
    use HasSlug, SoftDeletes;

    protected $appends = [
        'excerpt',
        'url'
    ];

    protected $dates = [
        'deleted_at',
        'last_reply_at'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getUrlAttribute()
    {
        return route('front::discussion.show', [$this->category->slug, $this->slug]);
    }

    public function getExcerptAttribute()
    {
        return Str::words($this->body, 20);
    }

    public function getHumanDateAttribute()
    {
        return $this->created_at->format('d-m-Y H:i');
    }

    public function getRelativeDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

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
