<?php

namespace App\Http\Controllers;

use App\Models\Reminder;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::with([
            'schedule.medicine'
        ])
            ->where('status', 'pending')
            ->orderBy('reminder_time')
            ->get();

        return view(
            'reminders.index',
            compact('reminders')
        );
    }

    public function history()
    {
        $reminders = Reminder::with([
            'schedule.medicine'
        ])
            ->where('status', 'sent')
            ->latest()
            ->get();

        return view(
            'reminders.history',
            compact('reminders')
        );
    }
}
