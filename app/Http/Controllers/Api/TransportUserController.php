<?php

namespace App\Http\Controllers\Api;

use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransportUser\StoreTransportUserRequest;
use App\Http\Resources\TransportUser\TransportSearchUserCollection;
use App\Http\Resources\TransportUser\TransportUserCollection;
use App\Http\Resources\TransportUser\TransportUserResource;
use App\Models\AcademicSession;
use App\Models\StudentSession;
use App\Models\TransportUser;
use App\Models\User;
use Illuminate\Http\Request;

class TransportUserController extends Controller
{

    protected $userLoader = [
        'user',
        'user.student_sessions',
        'transport_fees', 'transport_fees.transport_fees_items',
        'transport_fees.transport_fees_items.transport_fees_item_months',
        'transport', 'pickup_slot', 'drop_slot',
        'pickup_point', 'drop_point', 'journey_type',
        'student_session', 'student_session.next_student_session',
        'student_session.previous_student_session',
        'student_session.academic_class',
        'student_session.academic_session',
        'student_session.section'];

    public function index(Request $request)
    {
        $message = [];

        if ($request->has('transport_id')) {
            $users = TransportUser::with($this->userLoader)
                ->where('transport_id', $request->input('transport_id'))
                ->whereIn('user_id', function ($query) use ($request) {
                    $query->select('id')
                        ->from('users')
                        ->whereIn('user_type', ['student']);
                })->get();
            return new TransportUserCollection($users);
        }

        $users = TransportUser::with($this->userLoader)
            ->whereIn('user_id', function ($query) use ($request) {
                $query->select('id')
                    ->from('users')
                    ->whereIn('user_type', ['student']);
            })->get();
        return new TransportUserCollection($users);
        // return new StudentCollection($users);
    }
    public function search_users_for_transport(Request $request)
    {

        if ($request->has('search_text')) {

            $search = $request->input('search_text') . '%';
            // dd( $request->input('search_text'));
            $users = User::with(['student_sessions' => function ($query) {
                $query->with(['academic_class', 'section', 'academic_session'])
                    ->whereIn('academic_session_id', function ($subQuery) {
                        $subQuery->select('id')
                            ->from('academic_sessions')
                            ->where('is_current', 1);
                    });
            },
            'transport_fees',
            'transport_user'=>function($query){
                $query->with(['transport','journey_type']);
            }
            ])
                ->whereIn('user_type', ['student'])
                ->whereIn('id', function ($query) {
                    $query->select('student_id')
                        ->from('student_sessions')
                        ->whereIn('academic_session_id', function ($subQuery) {
                            $subQuery->select('id')
                                ->from('academic_sessions')
                                ->where('is_current', 1);
                        });
                })
                ->where('name', 'like', $search)
                ->orderBy('name')
                ->get();
            // dd($users);
            return new TransportSearchUserCollection($users);
        }

        return response()->json(
            [
                'data' => [],
                'status' => true,
                'message' => 'No User Found',
            ]
            , 200);
        // return new StudentCollection($users);
    }
    public function search_transport_users_for_fees(Request $request)
    {
        if ($request->has('search_text')) {
            $search = $request->input('search_text') . '%';
            // $users = User::whereIn('user_type', ['student'])
            //     ->where('name', 'like', $search)->orderBy('name')->get();

            // return new TransportSearchUserCollection($users);

            $users = TransportUser::with($this->userLoader)
                ->whereIn('user_id', function ($query) use ($request, $search) {
                    $query->select('id')
                        ->from('users')
                        ->where('name', 'like', $search)->orderBy('name')
                        ->whereIn('user_type', ['student', 'teacher']);
                })->get();
            return new TransportUserCollection($users);
        }

        return response()->json(
            [
                'data' => [],
                'status' => true,
                'message' => 'No User Found',
            ]
            , 200);
        // return new StudentCollection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransportUserRequest $request)
    {

        $data = $request->validated();
        $currentStudentSession = null;
        $user = User::find($data['user_id']);
        if (!$user) {
            return response()->json(
                [
                    'data' => [],
                    'status' => true,
                    'message' => 'User Not Found',
                ]
                , 200);
        }
// dd(UserTypeEnum::STUDENT);
        if ($user->user_type == UserTypeEnum::STUDENT) {
            //dd('Hello');
            $currentSession = AcademicSession::where('is_current', 1)->first();
            $currentStudentSession = StudentSession::where('academic_session_id', $currentSession->id)
                ->where('student_id', $data['user_id'])
                ->first();
            if (!$currentStudentSession) {
                return response()->json(
                    [
                        'data' => [],
                        'status' => true,
                        'message' => 'Student Is Not Enrolled In Current Academic Session',
                    ]
                    , 200);
            }
            $data['student_session_id'] = $currentStudentSession->id;

        }
        // dd('');
        $existingTransportUser = TransportUser::where('user_id', $data['user_id'])->first();
        //dd($existingTransportUser);
        if ($existingTransportUser) {
            if (!$data['is_active']) {
                if ($existingTransportUser->is_active) {
                    $existingTransportUser->dissociate_date = date('Y-m-d');
                }

            }

            $existingTransportUser->update($data);
            $transportUser = $existingTransportUser;
        } else {

            $transportUser = TransportUser::create($data);
        }
        //    $transportUser->save();
        return new TransportUserResource($transportUser);
    }

    /**
     * Display the specified resource.
     */
    public function show(TransportUser $transportUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransportUser $transportUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransportUser $transportUser)
    {
        //
    }
}
