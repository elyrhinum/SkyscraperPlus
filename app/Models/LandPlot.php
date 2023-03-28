<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class LandPlot extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'street_number',
        'plot_number',
        'area',
        'status'
    ];

    protected $casts = [
        'checkboxes'
    ];

    // CONNECTIONS
    public function ad()
    {
        return $this->morphOne(Ad::class, 'object');
    }

    public function characteristics()
    {
        $this->morphMany(ObjectAndCharacteristics::class, 'object');
    }
}
