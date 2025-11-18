<?php
namespace App\Http\Controllers;

use App\Models\ClassSchedule;
use Illuminate\Http\Request;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'year_level'    => 'required|string|max:255',
            'block_name'    => 'required|string|max:255',
            'subject_code'  => 'required|string|max:255',
            'subject_name'  => 'required|string|max:255',
            'schedule_time' => 'required|string|max:255',
            'room'          => 'required|string|max:255',
        ]);

        ClassSchedule::create($validated);

        return redirect()->back()->with('success', 'Class schedule added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSchedule $classSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSchedule $classSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassSchedule $classSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassSchedule $classSchedule)
    {
        //
    }
}
