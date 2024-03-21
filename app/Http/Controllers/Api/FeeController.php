<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Fee\StoreFeeRequest;
use App\Http\Requests\Fee\UpdateFeeRequest;
use App\Http\Resources\Fee\FeeCollection;
use App\Http\Resources\Fee\FeeResource;
use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new FeeCollection(Fee::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeeRequest $request)
    {
        $data = $request->validated();
        $fee = Fee::create($data);
        return new FeeResource($fee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Fee $fee)
    {
        return new FeeResource($fee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeeRequest $request, Fee $fee)
    {
        $data = $request->validated();
        $fee->update($data);
        return new FeeResource($fee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Fee $fee)
    {
        $fee->delete();
        return response(null, 204);
    }
}
