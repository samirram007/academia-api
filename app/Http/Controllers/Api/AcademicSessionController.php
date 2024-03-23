<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcademicSession\StoreAcademicSessionRequest;
use App\Http\Requests\AcademicSession\UpdateAcademicSessionRequest;
use App\Http\Resources\AcademicSession\AcademicSessionCollection;
use App\Http\Resources\AcademicSession\AcademicSessionResource;
use App\Models\AcademicSession;
use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userLoader=['campus'];
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
        return new AcademicSessionCollection(
            AcademicSession::with($this->userLoader)
            ->where('campus_id',$request->input('campus_id'))
            ->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAcademicSessionRequest $request)
    {
        $data = $request->validated();
        $academicSession = AcademicSession::create($data);
        return new AcademicSessionResource($academicSession);
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicSession $academicSession)
    {
        return new AcademicSessionResource($academicSession);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicSessionRequest $request, AcademicSession $academicSession)
    {
        $data = $request->validated();
        $academicSession->update($data);
        return new AcademicSessionResource($academicSession);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicSession $academicSession)
    {
        $academicSession->delete();
        return response(null, 204);
    }
}
