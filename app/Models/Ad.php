<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'status_id',
        'contract_id',
        'user_id',
        'object_type',
        'object_id',
        'comment',
        'price',
        'description',
        'created_at',
        'updated_at'
    ];

    // CONNECTIONS
    public function object()
    {
        return $this->morphTo();
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function contract()
    {
        return $this->hasOne(ContractType::class);
    }

    public function images()
    {
        return $this->hasMany(ImagesAd::class);
    }

    // METHODS
    public static function onlySuggested()
    {
        return Ad::where('status_id', 2);
    }

    public static function onlyPublished()
    {
        return Ad::where('status_id', 1);
    }

    public static function onlyCancelled()
    {
        return Ad::where('status_id', 3);
    }

    public static function onlyHidden()
    {
        return Ad::where('status_id', 4);
    }

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

    public function getNameOfAd()
    {
        return $this->objects()->district->name . ', ' . $this->objects()->street->name . ', ' . $this->objects()->street_number;
    }
}
