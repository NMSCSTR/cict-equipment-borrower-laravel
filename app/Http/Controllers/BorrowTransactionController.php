<?php

namespace App\Http\Controllers;

use App\Models\BorrowTransaction;
use Illuminate\Http\Request;

class BorrowTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $transactions = BorrowTransaction::all();
        return view('admin.transactions', compact('transactions'));
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
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'equipment_id' => 'required|exists:equipment,id',
            'borrowed_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrowed_date',
            'quantity' => 'required|integer|min:1',
            'purpose' => 'required|string|max:255',
            'status' => 'required|in:borrowed,returned,overdue',
            'remarks' => 'nullable|string',
            'class_schedule_id' => 'nullable|exists:class_schedules,id',
        ]);

        BorrowTransaction::create($validated);
        return redirect()->back()->with('success', 'Transaction created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BorrowTransaction $borrowTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BorrowTransaction $borrowTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BorrowTransaction $borrowTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BorrowTransaction $borrowTransaction)
    {
        //
    }
}
