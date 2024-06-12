<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Transport\StoreTransportRequest;
use App\Http\Requests\TransportUser\StoreTransportUserRequest;
use App\Http\Resources\TransportUser\TransportSearchUserCollection;
use App\Http\Resources\TransportUser\TransportUserCollection;
use App\Http\Resources\TransportUser\TransportUserResource;
use App\Models\TransportUser;
use App\Models\User;
use Illuminate\Http\Request;

class TransportUserController extends Controller
{

    protected $userLoader = ['user',
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
            ->where('transport_id',$request->input('transport_id'))
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
            })->orderBy('user.name')->get();
        return new TransportUserCollection($users);
        // return new StudentCollection($users);
    }
    public function search_users_for_transport(Request $request)
    {
        if ($request->has('search_text')) {
            $search = $request->input('search_text').'%';
            $users = User::whereIn('user_type', ['student'])
                    ->where('name','like',$search)->orderBy('name')->get();

        return new TransportSearchUserCollection($users);
        }

        return response()->json(
            [
                'data'=>[],
               'status'=>true,
               'message' => 'No User Found'
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
       $existingTransportUser =TransportUser::where('user_id',$data['user_id'])->first();
       //dd($existingTransportUser);
       if($existingTransportUser){
         $existingTransportUser->update($data);
         $transportUser = $existingTransportUser;
       }
       else{

           $transportUser = TransportUser::create($data);
       }
    //    $transportUser->save();
       return new TransportUserResource($transportUser );
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
