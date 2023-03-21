<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    // CONNECTIONS
    public function ads()
    {
        return $this->belongsTo(Ad::class);
    }

    public function complexes()
    {
        return $this->belongsTo(ResidentialComplex::class);
    }

}
