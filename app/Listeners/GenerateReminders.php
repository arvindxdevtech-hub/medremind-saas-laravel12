<?php

namespace App\Listeners;

use App\Events\ScheduleCreated;
use App\Models\Reminder;
use Carbon\Carbon;

class GenerateReminders
{
    public function handle(ScheduleCreated $event): void
    {
        $schedule = $event->schedule;

        $today = Carbon::now();

        // Build today's scheduled datetime
        $currentWeekReminder = Carbon::parse(
            $today->format('Y-m-d') . ' ' . $schedule->time
        );

        // If today is not the scheduled day,
        // move to the next occurrence of that day.
        if ($today->format('l') !== $schedule->day) {

            $currentWeekReminder = Carbon::parse(
                "next {$schedule->day}"
            )->setTimeFromTimeString(
                $schedule->time
            );
        }

        // If today is the scheduled day but time already passed,
        // move to next week.
        if (
            $today->format('l') === $schedule->day &&
            $currentWeekReminder->lessThan($today)
        ) {

            $currentWeekReminder->addWeek();
        }

        $nextWeekReminder = $currentWeekReminder
            ->copy()
            ->addWeek();

        Reminder::create([
            'schedule_id' => $schedule->id,
            'reminder_time' => $currentWeekReminder,
            'status' => 'pending',
        ]);

        Reminder::create([
            'schedule_id' => $schedule->id,
            'reminder_time' => $nextWeekReminder,
            'status' => 'pending',
        ]);
    }
}
