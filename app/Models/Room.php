<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'residential_complex_id',
        'district_id',
        'street_id',
        'repair_id',
        'street_number',
        'entrance',
        'floor',
        'number',
        'area',
        'layout'
    ];

    // CONNECTIONS
    public function ad()
    {
        $this->morphOne(Ad::class,  'object');
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
