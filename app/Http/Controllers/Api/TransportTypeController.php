<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransportType\TransportTypeCollection;
use App\Http\Resources\TransportType\TransportTypeResource;
use App\Models\TransportType;
use Illuminate\Http\Request;

class TransportTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return new TransportTypeCollection(TransportType::all());
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
    public function show(TransportType $transportFee)
    {
        return new TransportTypeResource($transportFee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransportType $transportFee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportType $transportFee)
    {
        //
    }
}
