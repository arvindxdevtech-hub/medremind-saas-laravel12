<?php

namespace App\Http\Controllers;

use App\Models\MedicineLog;
use Illuminate\Http\Request;

class MedicineLogController extends Controller
{
    public function store(Request $request)
    {
        MedicineLog::updateOrCreate(

            [
                'user_id' => auth()->id(),
                'medicine_id' => $request->medicine_id,
                'taken_date' => today(),
            ],

            [
                'status' => $request->status,
            ]
        );

        return back()
            ->with(
                'success',
                'Medicine status saved.'
            );
    }
}
