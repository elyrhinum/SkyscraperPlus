<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Flat extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'residential_complex_id',
        'repair_id',
        'street_number',
        'entrance',
        'floor',
        'number',
        'layout'
    ];

    // CONNECTIONS
    public function ad()
    {
        return $this->morphOne(Ad::class, 'object');
    }
}
