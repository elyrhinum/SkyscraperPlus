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

    public function complexes()
    {
        return $this->hasMany(ResidentialComplex::class);
    }

//    public function getComplex($id)
//    {
//        $complex = ResidentialComplex::find($id);
//        return District::find($complex->district_id);
//    }
}
