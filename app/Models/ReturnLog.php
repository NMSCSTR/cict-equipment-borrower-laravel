<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnLog extends Model
{
    protected $fillable = ['borrow_transaction_id', 'return_date', 'condition', 'remarks', 'user_id'];

    // Borrow transaction itself
    public function borrowTransaction()
    {
        return $this->belongsTo(BorrowTransaction::class);
    }

    // The borrower (via BorrowTransaction → User)
    public function borrower()
    {
        return $this->hasOneThrough(
            User::class,            // final model
            BorrowTransaction::class, // intermediate model
            'id',                   // FK on BorrowTransaction
            'id',                   // FK on User
            'borrow_transaction_id',// FK on ReturnLog
            'user_id'               // FK on BorrowTransaction
        );
    }

    // The receiver (staff who processed return → stored in return_logs.user_id)
    public function receiver()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Equipment (via BorrowTransaction)
    public function equipment()
    {
        return $this->hasOneThrough(
            Equipment::class,
            BorrowTransaction::class,
            'id',
            'id',
            'borrow_transaction_id',
            'equipment_id'
        );
    }
}
