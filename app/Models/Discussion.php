<?php namespace CreadoresIndie\Models;

use CreadoresIndie\Traits\HasEncodedId;
use CreadoresIndie\Traits\Shareable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Moloquent;
use Nicolaslopezj\Searchable\SearchableTrait;
use Overtrue\LaravelFollow\Traits\CanBeVoted;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Discussion extends Moloquent
{
    use CanBeVoted, HasEncodedId, HasSlug, Shareable, SearchableTrait, SoftDeletes;

    protected $appends = [
        'encoded_id',
        'excerpt',
        'has_social_preview'
    ];

    protected $casts = [
        'has_social_preview' => 'boolean',
        'sticky' => 'boolean'
    ];

    protected $dates = [
        'deleted_at',
        'last_reply_at'
    ];

    protected $fillable = [
        'title',
        'body',
        'replies_count'
    ];

    protected $perPage = 10;

    protected $shareOptions = [
        'columns' => [
            'title' => 'title'
        ],
        'url' => 'url'
    ];

    protected $searchable = [
        'columns' => [
            'discussions.title' => 10,
            'discussions.slug' => 10,
            'discussions.body' => 5,
        ]
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * @param Category|null $category
     * @return string
     */
    public function url($category = null)
    {
        $category = is_null($category) ? $this->category : $category;

        return route('front::discussion.show', [$category->slug, $this->slug]);
    }

    /** Custom attributes */

    /**
     * @return string
     */
    public function getExcerptAttribute()
    {
        $pattern = '/<p(.*?)>((.*?)+)\<\/p>/';
        $replacement = '${2} ';
        $out = preg_replace($pattern, $replacement, $this->body);

        $body = trim(strip_tags($out));

        return Str::words($body, 20);
    }

    /**
     * @return bool
     */
    public function getHasSocialPreviewAttribute()
    {
        return !is_null($this->social_preview);
    }

    /**
     * @return string
     */
    public function getHumanDateAttribute()
    {
        return $this->created_at->format('d-m-Y H:i');
    }

    /**
     * @return string
     */
    public function getHumanDateAltAttribute()
    {
        return $this->created_at->format('d M, Y');
    }

    /**
     * @return string
     */
    public function getParsedBodyAttribute()
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getRelativeDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * @return string
     */
    public function getSocialPreviewUrlAttribute()
    {
        return \Storage::disk('public')->url($this->social_preview);
    }

    /**
     * @return string
     */
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

    /** Scopes **/

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSticky($query)
    {
        return $query->whereSticky(true);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNoSticky($query)
    {
        return $query->whereSticky(false);
    }
}
