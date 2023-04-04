<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseLandPlotCharacteristic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'is_landplot'
    ];

    // CONNECTIONS
    public function objectAndCharacteristic()
    {
        return $this->morphMany(ObjectAndCharacteristics::class, 'object');
    }
}
