<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\StoreSchoolRequest;
use App\Http\Requests\School\UpdateSchoolRequest;
use App\Http\Resources\School\SchoolCollection;
use App\Http\Resources\School\SchoolResource;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        return new SchoolCollection(School::paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest $request)
    {
        $data = $request->validated();
        $school = School::create($data);
        return new SchoolResource($school);
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {

        return new SchoolResource($school);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        $data = $request->validated();
        $school->update($data);
        return new SchoolResource($school);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        $school->delete();
        return response(null, 204);
    }
}
