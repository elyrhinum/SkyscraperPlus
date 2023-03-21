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
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function contract()
    {
        return $this->hasOne(ContractType::class);
    }

    public function flat()
    {
        return $this->hasOne(Flat::class);
    }

    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function house()
    {
        return $this->hasOne(House::class);
    }

    public function landplot()
    {
        return $this->hasOne(LandPlot::class);
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

    public static function onlyInactive()
    {
        return Ad::where('status_id', 4);
    }
}
