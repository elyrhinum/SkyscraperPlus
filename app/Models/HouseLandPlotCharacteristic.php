<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseLandPlotCharacteristic extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'objects',
        'terrace',
        'bathhouse',
        'parking_space',
        'playground',
        'sports_ground',
        'security',
        'sewerage',
        'water_supply',
        'gas',
        'electricity',
        'heating'
    ];

    // CONNECTIONS
    public function landplot()
    {
        $this->belongsTo(LandPlot::class);
    }
}
