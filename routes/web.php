<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\MedicineLogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Medicines CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource('medicines', MedicineController::class);

    /*
    |--------------------------------------------------------------------------
    | schedules CRUD
    |--------------------------------------------------------------------------
    */

    Route::resource('schedules', ScheduleController::class);


    /*
    |--------------------------------------------------------------------------
    | Notifications
    |--------------------------------------------------------------------------
    */

    Route::get('/notifications', function () {

        return view('notifications.index', [
            'notifications' => auth()->user()
                ->notifications()
                ->latest()
                ->get()
        ]);
    })->name('notifications.index');

    Route::post('/notifications/{id}/read', function ($id) {

        $notification = auth()
            ->user()
            ->notifications()
            ->findOrFail($id);

        $notification->markAsRead();

        return back();
    })->name('notifications.read');

    Route::post('/notifications/read-all', function () {

        auth()
            ->user()
            ->unreadNotifications
            ->markAsRead();

        return back();
    })->name('notifications.readAll');


    /*
    |--------------------------------------------------------------------------
    | reminders
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/reminders',
        [ReminderController::class, 'index']
    )->name('reminders.index');

    Route::get(
        '/reminders/history',
        [ReminderController::class, 'history']
    )->name('reminders.history');


    /*
    |--------------------------------------------------------------------------
    | medicine-log
    |--------------------------------------------------------------------------
    */

    Route::post(
        '/medicine-log',
        [MedicineLogController::class, 'store']
    )->name('medicine-log.store');

    Route::post(
        '/medicine-log',
        [MedicineLogController::class, 'store']
    )->name('medicine-log.store');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
