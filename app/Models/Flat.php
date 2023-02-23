<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    protected $fillable = [
        'rc_id',
        'district_id',
        'street_id',
        'repair_id',
        'description',
        'building_number',
        'entrance',
        'floor',
        'flat_number',
        'images',
        'layout'
    ];

    // CONNECTIONS
    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }
}
