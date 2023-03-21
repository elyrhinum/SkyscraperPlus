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
        'street_number',
        'plot_number',
        'area',
        'status'
    ];

    protected $casts = [
        'checkboxes'
    ];

    // CONNECTIONS
    public function characteristics()
    {
        $this->morphMany(ObjectAndCharacteristics::class, 'object');
    }
}
