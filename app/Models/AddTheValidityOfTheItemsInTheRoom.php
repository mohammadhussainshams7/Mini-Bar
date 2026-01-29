<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\StandarInRoomMinibars;
use App\Models\Rooms;

class AddTheValidityOfTheItemsInTheRoom extends Model
{
        use SoftDeletes;
    protected $fillable = ['room_id' , "standar_in_room_minibar_id" , "date_of_manufacture"];
    // Optional: specify the date columns
    protected $dates = ['deleted_at'];

    public function standarinroomminibar()
    {
        return $this->belongsTo(StandarInRoomMinibars::class, 'standar_in_room_minibar_id');
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }
}
