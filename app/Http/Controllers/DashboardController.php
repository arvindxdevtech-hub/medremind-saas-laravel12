<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Schedule;
use App\Models\Reminder;
use Carbon\Carbon;
use App\Models\MedicineLog;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('dashboard', [

            'medicineCount' =>
            $user->medicines()->count(),

            'notificationCount' =>
            $user->unreadNotifications()->count(),

            'scheduleCount' =>
            Schedule::whereHas('medicine', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })->count(),

            'pendingReminderCount' =>
            Reminder::whereHas('schedule.medicine', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
                ->where('status', 'pending')
                ->count(),

            'sentReminderCount' =>
            Reminder::whereHas('schedule.medicine', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
                ->where('status', 'sent')
                ->count(),

            'recentMedicines' =>
            $user->medicines()
                ->latest()
                ->take(5)
                ->get(),

            'notifications' =>
            $user->notifications()
                ->latest()
                ->take(5)
                ->get(),

            'todaySchedules' =>
            Schedule::with('medicine')
                ->where('day', Carbon::now()->format('l'))
                ->whereHas('medicine', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })
                ->orderBy('time')
                ->get(),

            'medicineLogs' => MedicineLog::where(
                'user_id',
                $user->id
            )
                ->whereDate(
                    'taken_date',
                    today()
                )
                ->get()
                ->keyBy('medicine_id'),
        ]);
    }
}
