<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    // CONNECTIONS
    public function flat()
    {
        return $this->hasMany(Flat::class);
    }

    public function room()
    {
        return $this->hasMany(Room::class);
    }

    public function rc()
    {
        return $this->hasMany(ResidentialComplex::class);
    }
}
