<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    //
    protected $fillable = ['user_id', 'equipment_id', 'quantity', 'status','requested_date', 'remarks'];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
