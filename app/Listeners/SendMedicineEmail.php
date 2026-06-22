<?php

namespace App\Listeners;

use App\Events\MedicineCreated;
use App\Notifications\MedicineReminderNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMedicineEmail implements ShouldQueue
{
    public function handle(MedicineCreated $event): void
    {
        $user = $event->medicine->user;

        if (!$user) {
            return;
        }

        $user->notify(
            new MedicineReminderNotification(
                $event->medicine
            )
        );
    }
}
