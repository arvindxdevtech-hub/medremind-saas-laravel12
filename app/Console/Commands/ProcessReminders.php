<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reminder;
use App\Notifications\MedicineReminderNotification;
use Carbon\Carbon;

class ProcessReminders extends Command
{
    protected $signature = 'medicine:process-reminders';

    protected $description = 'Process pending medicine reminders';

    public function handle()
    {
        $reminders = Reminder::where('status', 'pending')
            ->where('reminder_time', '<=', now())
            ->get();

        // dd($reminders->toArray());

        foreach ($reminders as $reminder) {

            if ($reminder->status === 'sent') {
                continue;
            }

            $schedule = $reminder->schedule;
            $medicine = $schedule->medicine;
            $user = $medicine->user;



            // Mark current reminder as sent
            $reminder->update([
                'status' => 'sent',
            ]);

            // Send notification + email
            $user->notify(
                new MedicineReminderNotification($medicine)
            );

            /*
            |--------------------------------------------------------------------------
            | Create Future Reminder
            |--------------------------------------------------------------------------
            |
            | Example:
            |
            | Existing:
            | 23 Jun pending
            | 30 Jun pending
            |
            | When 23 Jun is sent:
            | Create 07 Jul pending
            |
            */

            $nextReminderTime = Carbon::parse(
                $reminder->reminder_time
            )->addWeeks();

            $alreadyExists = Reminder::where(
                'schedule_id',
                $schedule->id
            )->where(
                'reminder_time',
                $nextReminderTime
            )->exists();

            if (!$alreadyExists) {

                Reminder::create([
                    'schedule_id' => $schedule->id,
                    'reminder_time' => $nextReminderTime,
                    'status' => 'pending',
                ]);
            }

            $this->info(
                "Reminder Sent: {$medicine->name}"
            );
        }

        return Command::SUCCESS;
    }
}
