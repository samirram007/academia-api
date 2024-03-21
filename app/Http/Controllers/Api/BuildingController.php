<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Building\StoreBuildingRequest;
use App\Http\Requests\Building\UpdateBuildingRequest;
use App\Http\Resources\Building\BuildingCollection;
use App\Http\Resources\Building\BuildingResource;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return new BuildingCollection(Building::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuildingRequest $request)
    {
        $data = $request->validated();
        $building = Building::create($data);
        return new BuildingResource($building);
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {

        return new BuildingResource($building);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBuildingRequest $request, Building $building)
    {
        $data = $request->validated();
        $building->update($data);
        return new BuildingResource($building);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        $building->delete();
        return response(null, 204);
    }
}
