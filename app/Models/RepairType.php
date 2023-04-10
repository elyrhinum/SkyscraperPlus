<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairType extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    // CONNECTIONS
    public function flats()
    {
        return $this->hasMany(Flat::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
