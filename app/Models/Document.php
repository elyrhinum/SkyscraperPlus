<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document'
    ];

    // METHODS
    public function dateOfCreating(): Attribute
{
    return Attribute::make(
        get: fn() => $this->created_at->format('d.m.Y')
    );
}

    public function dateOfUpdating(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->updated_at->format('d.m.Y')
        );
    }
}
