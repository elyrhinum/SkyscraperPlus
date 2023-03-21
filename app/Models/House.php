<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type_id',
        'district_id',
        'street_id',
        'street_number',
        'plot_number',
        'building_number',
        'building_area',
        'floors',
        'bedrooms',
        'bathrooms',
        'bathroom_place',
        'building_year',
        'building_material',
        'building_status',
        'plot_area',
        'plot_status'
    ];

    protected $casts = [
        'checkboxes'
    ];

    // CONNECTIONS
    public function characteristics()
    {
        $this->morphMany(HouseLandPlotCharacteristic::class, 'object');
    }
}
