<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResidentialComplex extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'district_id',
        'class_id',
        'name',
        'description'
    ];

    // СВЯЗИ
    public function class()
    {
        return $this->belongsTo(ComplexClass::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function images()
    {
        return $this->hasMany(ImagesComplex::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // МЕТОДЫ
    public static function onlySuggested()
    {
        return ResidentialComplex::where('status_id', 2);
    }

    public static function onlyPublished()
    {
        return ResidentialComplex::where('status_id', 1);
    }

    public static function onlyHidden()
    {
        return ResidentialComplex::where('status_id', 4);
    }

    public static function onlyCancelled()
    {
        return ResidentialComplex::where('status_id', 3);
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
}
