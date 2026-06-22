<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'medicine_id',
        'day',
        'time'
    ];

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }
}
