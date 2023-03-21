<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectAndCharacteristics extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected  $fillable = [
        'object_id',
        'object_type',
        'characteristic_id'
    ];

    // CONNECTIONS
    public function object()
    {
        $this->morph();
    }
}
