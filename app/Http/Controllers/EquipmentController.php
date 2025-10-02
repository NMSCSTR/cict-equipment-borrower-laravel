<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return view('admin.equipment');
        $equipment = Equipment::all();
        return view('admin.equipment', compact('equipment'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Equipment $equipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Equipment $equipment)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $validated = $request->validate([
            'equipment_name' => 'required',
            'description' => 'max:500',
            'quantity' => 'required|integer',
            'available_quantity' => 'required|integer',
            'status' => 'required',
        ]);


        $update = Equipment::where('id', $request->id)->update($validated);
        return redirect()->back()->with('success', 'Equipment updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $equipment = Equipment::findOrFail($id);
        $equipment->delete();
        return redirect()->back()->with('success', 'Equipment deleted successfully.');
    }
}
