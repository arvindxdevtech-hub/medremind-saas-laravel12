<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $medicines = Medicine::all();

        $schedules = Schedule::with('medicine')
            ->latest()
            ->get();

        return view(
            'schedules.index',
            compact('medicines', 'schedules')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required',
            'day' => 'required',
            'time' => 'required',
        ]);

        Schedule::create([
            'medicine_id' => $request->medicine_id,
            'day' => $request->day,
            'time' => $request->time,
        ]);

        $schedule = Schedule::latest()->first();
        event(new \App\Events\ScheduleCreated($schedule));

        return back()
            ->with(
                'success',
                'Schedule Added Successfully'
            );
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return back()
            ->with(
                'success',
                'Schedule Deleted Successfully'
            );
    }
}
