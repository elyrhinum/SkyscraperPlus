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
        'district_id',
        'street_id',
        'status_id',
        'contract_id',
        'user_id',
        'object_type',
        'object_id',
        'comment',
        'price',
        'description',
    ];

    // CONNECTIONS
    public function object()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function street()
    {
        return $this->belongsTo(Street::class);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function contract()
    {
        return $this->belongsTo(ContractType::class);
    }

    public function images()
    {
        return $this->hasMany(ImagesAd::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(UserBookmark::class);
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

    public function getCorrectObjectType()
    {
        if ($this->object_type == '\App\Models\LandPlot') {
            return 'Земельный участок';
        } else if ($this->object_type == '\App\Models\House') {
            if ($this->object->type_id == 1) {
                return "Дом/коттедж";
            } else if ($this->object->type_id == 2) {
                return "Дача";
            }
        } else if ($this->object_type == '\App\Models\Flat') {
            return 'Квартира';
        } else if ($this->object_type == '\App\Models\Room') {
            return 'Комната';
        }
    }

    public function getNameOfObject()
    {
        if ($this->object_type == '\App\Models\House' || $this->object_type == '\App\Models\LandPlot') {
            if ($this->object->plot_number == 0) {
                return $this->district->name . ' р-н, ' . $this->street->name . ' ' . $this->object->street_number;
            } else {
                return $this->district->name . ' р-н, ' . $this->street->name . ' ' . $this->object->street_number . ', уч. ' . $this->object->plot_number;
            }
        } else if ($this->object_type == '\App\Models\Flat' || $this->object_type == '\App\Models\Room') {
            return $this->district->name . ' р-н, ' . $this->street->name . ' ' . $this->object->street_number . ', п. ' . $this->object->entrance . ', кв. ' . $this->object->number;
        }
    }

    // GET CORRECT PRICE
    public function getCorrectPrice()
    {
        if ($this->contract->name == 'Продажа') {
            return $this->price . ' ₽';
        } else if ($this->contract->name == 'Долгосрочная аренда') {
            return $this->price . ' ₽ / мес.';
        } else if ($this->contract->name == 'Посуточная аренда') {
            return $this->price . ' ₽ / сут.';
        }
    }
}
