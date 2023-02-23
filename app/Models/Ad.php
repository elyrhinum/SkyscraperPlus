<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'contract_id',
        'realtor_id',
        'user_id',
        'flat_id',
        'room_id',
        'house_id',
        'landplot_id',
        'price'
    ];

    // CONNECTIONS
    public function status()
    {
        return $this->hasOne(Status::class);
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
}
