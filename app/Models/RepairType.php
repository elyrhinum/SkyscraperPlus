<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairType extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

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
