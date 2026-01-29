<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AddTheValidityOfTheItemsInTheRoom;


class Rooms extends Model
{
    protected $fillable = ['roomNumber','note'];


    public function addTheValidityOfTheItemsInTheRooms()
    {
        return $this->hasMany(AddTheValidityOfTheItemsInTheRoom::class);
    }
}
