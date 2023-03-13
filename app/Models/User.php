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

    // METHODS
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->surname . " " . $this->name . " " . $this->patronymic
        );
    }

    public function shortName(): Attribute
    {
        return Attribute::make(
            get: fn() => strtoupper(substr($this->name, 0,1)) . '. ' . strtoupper(substr($this->patronymic, 0, 1)) . '. ' . $this->surname
        );
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    // CONNECTIONS
    public function role()
    {
        return $this->hasOne(Role::class);
    }
}
