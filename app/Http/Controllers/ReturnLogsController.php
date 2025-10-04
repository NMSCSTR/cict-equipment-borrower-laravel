<?php

namespace App\Http\Controllers;

use App\Models\ReturnLog;
use App\Models\Equipment;
use Illuminate\Http\Request;

class ReturnLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $returnLogs = ReturnLog::with('users', 'equipment')->orderBy('created_at', 'desc')->get();
        // return view('admin.logs', compact('returnLogs'));
        return $returnLogs;


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
    public function show(ReturnLog $returnLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReturnLog $returnLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReturnLog $returnLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReturnLog $returnLog)
    {
        //
    }
}
