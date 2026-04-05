<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Resources\Auth\AuthUserResource;
use App\Models\AcademicSession;

class AuthController extends Controller
{
    public function register(SignupRequest $request){
        $data = $request->validated();
        /** @var \App\Models\User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $token = $user->createToken('myApp')->accessToken;
        $response = [
            'data' => new AuthUserResource($user),
            'token' => $token,
            'message' => 'Successfully registered'
        ];
        return response()->json($response,201);
        // return response(compact('user', 'token'));

    }
    public function login(LoginRequest $request){

        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return response([
                'message' => 'Provided username or password is incorrect',
            ], 422);

        }

        // $user = User::find($credentials);
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $token = $user->createToken('myApp')->accessToken;
        $response = [
            'data' => new AuthUserResource($user),
            'token' => $token,
            'message' => 'Successfully logged In'
        ];

        return response($response, 200);
        //   return response(compact('data', 'token'));

    }
    public function user(){

        $academic_session=AcademicSession::where('is_current',1)->first();

        return new UserResource(Auth::user());
    }
    public function refresh(){
         /** @var \App\Models\User $user  */
         $user=Auth::user();
        $token =  $user->createToken('myApp')->accessToken;
        return response(['token' => $token], 200);
    }
    public function logout(){
     //   Auth::logout();

         /** @var \App\Models\User $user  */
        $user=Auth::user();
        $user->token()->revoke() ;
        return response(['message' => 'Successfully logged out'], 200);
    }
}
