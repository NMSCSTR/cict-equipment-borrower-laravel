<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnLogs extends Model
{
    //
    protected $fillable = ['transaction_id', 'return_date', 'condition', 'remarks'];

    public function borrowTransaction()
    {
        return $this->belongsTo(BorrowTransaction::class);
    }
}
