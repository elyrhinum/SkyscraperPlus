<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplexClass extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    // CONNECTIONS
    public function complex()
    {
        return $this->hasMany(ResidentialComplex::class);
    }
}
