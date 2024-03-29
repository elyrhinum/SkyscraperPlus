<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class House extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type_id',
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
    public function ad()
    {
        $this->morphOne(Ad::class, 'object');
    }

    public function plotType()
    {
        return $this->belongsTo(PlotType::class);
    }

    public function characteristics()
    {
        $this->morphMany(HouseLandPlotCharacteristic::class, 'object');
    }
}
