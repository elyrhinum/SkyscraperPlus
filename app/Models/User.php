<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    public function role()
    {
        return $this->hasOne(Role::class);
    }

    // METHODS
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->surname . " " . $this->name . " " . $this->patronymic
        );
    }

    public function getShortNameAttribute()
    {
        return strtoupper(mb_substr($this->name, 0,1)) . '. ' . strtoupper(mb_substr($this->patronymic, 0, 1)) . '. ' . $this->surname;
    }
}
