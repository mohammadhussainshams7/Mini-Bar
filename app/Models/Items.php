<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ItemExpired;
use App\Models\StandarInRoomMinibars;

class Items extends Model
{
    protected $fillable = ['name', 'dependency'];

    public function expiries()
    {
        return $this->hasMany(ItemExpired::class);
    }

     public function StandarInRoomMinibar()
    {
        return $this->hasMany(StandarInRoomMinibars::class);
    }
}

