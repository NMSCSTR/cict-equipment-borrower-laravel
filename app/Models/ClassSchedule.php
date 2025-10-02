<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    //
    protected $fillable = ['instructor_id', 'year_level', 'block_name', 'subject_code', 'subject_name', 'schedule_time', 'room'];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function borrowTransactions()
    {
        return $this->hasMany(BorrowTransaction::class);
    }
}
