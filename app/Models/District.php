<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

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

    public function house()
    {
        return $this->hasMany(House::class);
    }

    public function landplot()
    {
        return $this->hasMany(LandPlot::class);
    }

    public function complexes()
    {
        return $this->hasMany(ResidentialComplex::class);
    }
}
