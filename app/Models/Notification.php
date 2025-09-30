<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable = ['user_id', 'message', 'notification_type', 'send_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
