<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    // CONNECTIONS
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    public function complexes()
    {
        return $this->hasMany(ResidentialComplex::class);
    }
}
