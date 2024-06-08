<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Student\StudentCollection;
use App\Models\AcademicClass;
use App\Models\StudentSession;
use App\Models\User;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $userLoader = ['academic_session',  'academic_class', 'campus', 'address', 'address.state', 'address.country', 'addresses', 'addresses.state', 'addresses.country',
        'designation', 'department', 'profile_document', 'guardians',
        'student_sessions', 'student_sessions.next_student_session','student_sessions.previous_student_session','student_sessions.academic_class', 'student_sessions.academic_session', 'student_sessions.section'];

    protected $foreignLoader = ['student', 'student.profile_document', 'academic_session', 'academic_class', 'academic_standard'];
    public function index(Request $request)
    {
        $message = [];

        if (!$request->has('campus_id')) {
            array_push($message, 'Please provide campus');
        }
        if (!$request->has('academic_session_id')) {
            array_push($message, 'Please provide academic session');
        }
        if (!$request->has('academic_class_id')) {
            array_push($message, 'Please provide academic class');
        }
        if ($message) {
            return response()->json(
                [
                    'status' => false,
                    'message' => $message,
                ]
                , 400);
        }

        $users = User::with($this->userLoader)
            ->where('user_type', 'student')
            ->whereIn('id', function ($query) use ($request) {
                $query->select('student_id')
                    ->from('student_sessions')
                    ->whereIn('academic_session_id', [$request->input('academic_session_id')])
                    ->whereIn('academic_class_id', [$request->input('academic_class_id')]);
            })->get();
        return new StudentCollection($users);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $academic_class=AcademicClass::find($request->input('newData')['academic_class_id']);
        foreach ($request->input('students') as $key => $data) {
            $oldStudentSession=StudentSession::find($data['previous_student_session_id']);

             $studentSession=$data['new_student_session_id']?StudentSession::find($data['new_student_session_id']): new StudentSession();
            // $studentSession=  new StudentSession();

            $studentSessionData['student_id']=$data['student_id'];
            $studentSessionData['previous_student_session_id']=$data['previous_student_session_id'];
            $studentSessionData['campus_id']=$request->input('newData')['campus_id'];
            $studentSessionData['academic_session_id']=$request->input('newData')['academic_session_id'];
            $studentSessionData['academic_class_id']=$request->input('newData')['academic_class_id'];
            $studentSessionData['academic_standard_id']=$academic_class->academic_standard_id;
            $studentSessionData['status']=2;
            $studentSessionData['section_id']=$oldStudentSession->section_id;
            //$studentSession->save();
            $studentSession=StudentSession::create($studentSessionData);

            $oldStudentSession->is_promoted=1;
            $oldStudentSession->next_student_session_id=$studentSession->id;
           //  dd($studentSession,$oldStudentSession);
            $oldStudentSession->save();

        }
//  dd($oldStudentSession);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
