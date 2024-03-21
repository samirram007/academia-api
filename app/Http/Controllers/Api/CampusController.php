<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Campus\StoreCampusRequest;
use App\Http\Requests\Campus\UpdateCampusRequest;
use App\Http\Resources\Campus\CampusCollection;
use App\Http\Resources\Campus\CampusResource;
use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $campus = Campus::with(['address','school','education_board'])->get();
        return new CampusCollection($campus);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampusRequest $request)
    {

        $data = $request->validated();
        $campus = Campus::create($data);
        return new CampusResource($campus);
    }

    /**
     * Display the specified resource.
     */
    public function show(Campus $campus)
    {

        return new CampusResource($campus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampusRequest $request, Campus $campus)
    {
        $data = $request->validated();
        $campus->update($data);
        return new CampusResource($campus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campus $campus)
    {
        $campus->delete();
        return response(null, 204);
    }
}
