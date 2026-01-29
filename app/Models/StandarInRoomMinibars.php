<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Items;
use App\Models\AddTheValidityOfTheItemsInTheRoom;

class StandarInRoomMinibars extends Model
{


    protected $fillable = ['item_id'];
    public function item()
    {
        return $this->belongsTo(Items::class);
    }


    public function addthevalidityoftheitemsintherooms()
    {
        return $this->hasMany(AddTheValidityOfTheItemsInTheRoom::class);
    }




}
