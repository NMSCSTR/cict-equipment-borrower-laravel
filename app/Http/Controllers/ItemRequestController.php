<?php

namespace App\Http\Controllers;

use App\Models\ItemRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ItemRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = ItemRequest::all();
        $users = User::all();
        return view('admin.request', compact('requests', 'users'));
        // return $requests;
    }

    public function requestActions(Request $request)
    {
        $itemRequest = ItemRequest::findOrFail($request->id);

        if ($request->route()->getName() === 'admin.request.approve') {
            $itemRequest->status = 'Approved';
        } elseif ($request->route()->getName() === 'admin.request.decline') {
            $itemRequest->status = 'Declined';
        }

        $itemRequest->save();

        return back()->with('success', 'Request has been ' . strtolower($itemRequest->status) . '.');
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
    public function show(ItemRequest $itemRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemRequest $itemRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemRequest $itemRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $itemRequest = ItemRequest::findOrFail($id);
        $itemRequest->delete();
        return back()->with('success', 'Request has been deleted.');
    }
}
