<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Medicine;
use App\Events\MedicineCreated;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('medicines.index', compact('medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $medicine = Medicine::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
        ]);

        event(new MedicineCreated($medicine));

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine Added Successfully');
    }

    public function edit(Medicine $medicine)
    {
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $medicine->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine Updated Successfully');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();

        return redirect()
            ->route('medicines.index')
            ->with('success', 'Medicine Deleted Successfully');
    }
}
