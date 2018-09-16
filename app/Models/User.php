<?php namespace CreadoresIndie\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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

    public function getUrlAttribute()
    {
        return route('front::user.show', $this->username);
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
