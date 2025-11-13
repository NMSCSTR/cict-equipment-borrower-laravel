<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    //
    protected $table = 'equipment';
    
    protected $fillable = ['equipment_name', 'description', 'quantity', 'available_quantity', 'status'];

    public function borrowTransactions()
    {
        return $this->hasMany(BorrowTransaction::class);
    }

    public function itemRequests()
    {
        return $this->hasMany(ItemRequest::class);
    }

}
