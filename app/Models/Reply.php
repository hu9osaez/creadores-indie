<?php namespace CreadoresIndie\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Markdown;

class Reply extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'body'
    ];

    public function getParsedBodyAttribute()
    {
        $body = Markdown::convertToHtml($this->body);
        $body = preg_replace(
            '/((http)+(s)?:\/\/[^<>\s]+)/i',
            '<a href="$0" target="_blank" rel="nofollow">$0</a>', $body);

        return $body;
    }

    public function getRelativeDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'id_discussion');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
