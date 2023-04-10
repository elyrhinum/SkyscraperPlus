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
        return $this->morphTo(Ad::class);
    }

    public function residential_complex()
    {
        return $this->belongsTo(ResidentialComplex::class);
    }

    public function characteristics()
    {
        return $this->morphedByMany(RoomFlatCharacteristic::class, 'object');
    }

    public function repair()
    {
        return $this->belongsTo(RepairType::class);
    }
}
