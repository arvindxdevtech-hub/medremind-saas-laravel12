<?php

namespace App\Events;

use App\Models\Medicine;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MedicineCreated
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public Medicine $medicine
    ) {}
}
