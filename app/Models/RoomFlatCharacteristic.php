<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFlatCharacteristic extends Model
{
    use HasFactory;

    protected $fillable = [
        'object',
        'ceiling_height',
        'floors',
        'living_rooms_amount',
        'bathrooms_amount',
        'living_area',
        'total_area',
        'kitchen_area'
    ];

    public $timestamps = false;

    // CONNECTIONS
//    public function flat() {
//        return $this->morphTo();
//    }
//
//    public function room()
//    {
//        return $this->morphTo();
//    }
}
