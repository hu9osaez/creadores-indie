<?php namespace CreadoresIndie\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Overtrue\LaravelFollow\Traits\CanVote;
use QCod\ImageUp\HasImageUploads;
use Spatie\Activitylog\Traits\CausesActivity;

class User extends Authenticatable
{
    use CanVote, CausesActivity, HasImageUploads, LaratrustUserTrait, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $autoUploadImages = false;

    protected static $imageFields = [
        'avatar' => [
            'width' => 200,
            'height' => 200,
            'path' => 'avatars',
            'placeholder' => '/img/default-avatar.png',
        ],
    ];

    public function getAvatarUrlAttribute()
    {
        return $this->imageUrl('avatar');
    }

    public function getUrlAttribute()
    {
        return route('front::profile.show', $this->username);
    }

    public function getUsernamePublicAttribute()
    {
        return "@{$this->username}";
    }

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = bcrypt($pass);
    }

    public function discussions()
    {
        return $this->hasMany(Discussion::class, 'id_user');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'id_user');
    }
}
