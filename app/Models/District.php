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
        return $this->belongsTo(Flat::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function landplot()
    {
        return $this->belongsTo(LandPlot::class);
    }

    public function rc()
    {
        return $this->belongsTo(ResidentialComplex::class);
    }
}
