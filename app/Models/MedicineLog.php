<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineLog extends Model
{
    protected $fillable = [
        'user_id',
        'medicine_id',
        'taken_date',
        'status',
    ];

    public function medicine()
    {
        return $this->belongsTo(
            Medicine::class
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }
}
