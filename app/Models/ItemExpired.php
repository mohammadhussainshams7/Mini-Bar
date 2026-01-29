<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Items;


class ItemExpired extends Model
{
    protected $fillable = ['item_id', 'expiry_date'];

    public function item()
    {
        return $this->belongsTo(Items::class);
    }
}
