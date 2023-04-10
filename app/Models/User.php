<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;

    protected $fillable = [
        'role_id',
        'name',
        'surname',
        'patronymic',
        'email',
        'telephone',
        'image',
        'login',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [

    ];

    // CONNECTIONS
    public function ads()
    {
       return $this->hasMany(Ad::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(UserBookmark::class);
    }

    // METHODS
    public function hasRole()
    {
        return in_array($this->role->name, ['Администратор', 'Модератор']);
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->surname . " " . $this->name . " " . $this->patronymic
        );
    }

    public function getShortNameAttribute()
    {
        if ($this->patronymic != null)
            return strtoupper(mb_substr($this->name, 0,1)) . '. ' . strtoupper(mb_substr($this->patronymic, 0, 1)) . '. ' . $this->surname;
        else
            return strtoupper(mb_substr($this->name, 0,1)) . '. ' . $this->surname;
    }

    public function isBookmarked($ad_id)
    {
        if (count($this->bookmarks()->where('ad_id', $ad_id)->get()) > 0) {
            return 'true';
        } else {
            return 'false';
        }
    }
}
