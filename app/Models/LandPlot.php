<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandPlot extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'district_id',
        'street_id',
        'number',
        'area',
        'status'
    ];

    // CONNECTIONS
    public function characteristics()
    {
        $this->hasMany(HouseLandPlotCharacteristic::class);
    }
}
