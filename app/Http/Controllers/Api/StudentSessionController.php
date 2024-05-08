<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentSession\StoreStudentSessionRequest;
use App\Http\Resources\StudentSession\StudentSessionCollection;
use App\Http\Resources\StudentSession\StudentSessionResource;
use App\Models\StudentSession;
use Illuminate\Http\Request;

class StudentSessionController extends Controller
{
    protected $foreignLoader=['student','student.profile_document','academic_session','academic_class','academic_standard'];
    public function index(Request $request)
    {
        $message=[];

        if(!$request->has('campus_id')){
           array_push($message,'Please provide campus');
        }
        if(!$request->has('academic_session_id')){
           array_push($message,'Please provide academic session');
        }
        if(!$request->has('academic_class_id')){
            array_push($message,'Please provide academic Class');
        }
        if($message){
            return response()->json(
                [
                   'status'=>false,
                   'message' => $message
                ]
           , 400);
        }
        $studentSessions=StudentSession::with($this->foreignLoader)
        ->where('academic_session_id',$request->input('academic_session_id'))
        ->where('academic_class_id',$request->input('academic_class_id'))
        ->get();
        return new StudentSessionCollection($studentSessions);
    }
    public function StudentSessionsByStudentId($student_id)
    {
       // dd($student_id);
        $studentSessions=StudentSession::with($this->foreignLoader)->where('student_id',$student_id)->get();
        return new StudentSessionCollection($studentSessions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentSessionRequest $request)
    {
        $data = $request->validated();
        $studentSessions = StudentSession::create($data);
       // dd($data,$user);
        return new StudentSessionResource($studentSessions->load($this->foreignLoader));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $loader=array_merge($this->foreignLoader,['student.guardians','student.addresses','student.address']);

       $studentSession= StudentSession::with($loader)->latest()->find($id);
       return new StudentSessionResource($studentSession);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
