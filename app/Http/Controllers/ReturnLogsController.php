<?php

namespace App\Http\Controllers;

use App\Models\ReturnLog;
use Illuminate\Http\Request;

class ReturnLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $returnLogs = ReturnLog::with('user', 'equipment')->orderBy('returned_at', 'desc')->get();
        return view('admin.logs', compact('returnLogs'));


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
