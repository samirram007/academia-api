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
    protected $userLoader=['campus','academic_standard','section'];
    public function index(Request $request)
    {
        $message=[];


        if(!$request->has('campus_id')){
            array_push($message,'Please provide campus_id');
        }
        if($message){
            return response()->json(
                [
                   'status'=>false,
                   'message' => $message
                ]
           , 400);
        }
        return new AcademicClassCollection(
            AcademicClass::with($this->userLoader)
            ->where('campus_id',$request->input('campus_id'))
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
