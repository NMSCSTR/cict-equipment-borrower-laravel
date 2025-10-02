<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowTransaction extends Model
{
    //
    protected $fillable = ['user_id', 'equipment_id','borrow_date', 'return_date', 'quantity','purpose', 'status', 'remarks','class_schedule_id'];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function classSchedule()
    {
        return $this->belongsTo(ClassSchedule::class);
    }

    public function returnLog()
    {
        return $this->hasOne(ReturnLog::class);
    }
}
