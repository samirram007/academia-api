<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Transport\TransportCollection;
use App\Http\Resources\Transport\TransportResource;
use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new TransportCollection(Transport::all());
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
    public function show(Transport $transport)
    {
        return new TransportResource($transport);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transport $transportFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transportFee)
    {
        //
    }
}
