<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Floor\StoreFloorRequest;
use App\Http\Requests\Floor\UpdateFloorRequest;
use App\Http\Resources\Floor\FloorCollection;
use App\Http\Resources\Floor\FloorResource;
use App\Models\Floor;
use Illuminate\Http\Request;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return new FloorCollection(Floor::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFloorRequest $request)
    {
        $data = $request->validated();
        $floor = Floor::create($data);
        return new FloorResource($floor);
    }

    /**
     * Display the specified resource.
     */
    public function show(Floor $floor)
    {

        return new FloorResource($floor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFloorRequest $request, Floor $floor)
    {
        $data = $request->validated();
        $floor->update($data);
        return new FloorResource($floor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Floor $floor)
    {
        $floor->delete();
        return response(null, 204);
    }
}
