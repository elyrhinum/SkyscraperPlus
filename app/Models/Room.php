<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'complex_id',
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
}
