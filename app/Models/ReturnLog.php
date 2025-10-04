<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnLog extends Model
{
    //
    protected $fillable = ['borrow_transaction_id', 'return_date', 'condition', 'remarks'];

    public function borrowTransaction()
    {
        return $this->belongsTo(BorrowTransaction::class);
    }
    public function users()
    {
        return $this->hasOneThrough(User::class, BorrowTransaction::class, 'id', 'id', 'borrow_transaction_id', 'user_id');
    }
    public function equipment()
    {
        return $this->hasOneThrough(Equipment::class, BorrowTransaction::class, 'id', 'id', 'borrow_transaction_id', 'equipment_id');
    }
}
