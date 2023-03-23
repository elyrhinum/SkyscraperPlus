<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesComplex extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'residential_complex_id',
        'image'
    ];

    // CONNECTIONS
    public function complex()
    {
        return $this->belongsTo(ResidentialComplex::class);
    }

}
