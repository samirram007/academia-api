<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicClass\StoreAcademicClassRequest;
use App\Http\Requests\AcademicClass\UpdateAcademicClassRequest;
use App\Http\Resources\AcademicClass\AcademicClassCollection;
use App\Http\Resources\AcademicClass\AcademicClassResource;
use App\Models\AcademicClass;
use Illuminate\Http\Request;

class AcademicClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!$request->has('campus_id')){
            return response()->json(
            [
                'status'=>false,
                'message' => 'Please provide campus_id'
                ]
            , 400);
        }
        return new AcademicClassCollection(
            AcademicClass
            ::where('campus_id',$request->input('campus_id'))
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicClassRequest $request)
    {
        $data = $request->validated();
        $academicClass = AcademicClass::create($data);
        return new AcademicClassResource($academicClass);
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicClass $academicClass)
    {
        return new AcademicClassResource($academicClass);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicClassRequest $request, AcademicClass $academicClass)
    {
        $data = $request->validated();
        $academicClass->update($data);
        return new AcademicClassResource($academicClass);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicClass $academicClass)
    {
        $academicClass->delete();
        return response(null, 204);
    }
}
