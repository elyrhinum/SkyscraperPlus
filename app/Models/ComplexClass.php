<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    // CONNECTIONS
    public function rc()
    {
        return $this->belongsTo(ResidentialComplex::class);
    }
}
