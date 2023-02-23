<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSaved extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'ad_id'
    ];

    // CONNECTIONS
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function ad() {
        return $this->belongsTo(Ad::class);
    }
}
