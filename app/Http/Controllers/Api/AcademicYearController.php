<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicYear\StoreAcademicYearRequest;
use App\Http\Requests\AcademicYear\UpdateAcademicYearRequest;
use App\Http\Resources\AcademicYear\AcademicYearCollection;
use App\Http\Resources\AcademicYear\AcademicYearResource;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
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
        return new AcademicYearCollection(
            AcademicYear
            ::where('campus_id',$request->input('campus_id'))
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicYearRequest $request)
    {
        $data = $request->validated();
        $academicYear = AcademicYear::create($data);
        return new AcademicYearResource($academicYear);
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicYear $academicYear)
    {
        return new AcademicYearResource($academicYear);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicYearRequest $request, AcademicYear $academicYear)
    {
        $data = $request->validated();
        $academicYear->update($data);
        return new AcademicYearResource($academicYear);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        return response(null, 204);
    }
}
