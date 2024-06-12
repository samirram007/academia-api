<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transport\StoreTransportRequest;
use App\Http\Requests\Transport\UpdateTransportRequest;
use App\Http\Resources\Transport\TransportCollection;
use App\Http\Resources\Transport\TransportResource;
use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    protected $lazyLoader=['transport_type'];
    public function index()
    {
        return new TransportCollection(Transport::with($this->lazyLoader)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransportRequest $request)
    {
        $data = $request->validated();
        $subject = Transport::create($data);
        return new TransportResource($subject->load($this->lazyLoader));

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
    public function update(UpdateTransportRequest $request, Transport $transport)
    {
        $data = $request->validated();
        $transport->update($data);
        return new TransportResource($transport->load($this->lazyLoader));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transportFee)
    {
        //
    }
}
