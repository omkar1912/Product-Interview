<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AuthRegisterRequest;

class AuthController extends Controller
{
    public function register(AuthRegisterRequest $request)
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request['password']),
        ]);

        if($user)
        {
            Mail::to($request->email)->send(new WelcomeMail($user));
            return response()->json([
                'data'=> $user,
                'token'=>$user->createToken($user->email.'-'.now())->accessToken,
                'messgae' => "User Registered Successfully"
            ],200);
        }
        else{
            return response()->json([
                'message' => "Data Not saved Properly",
            ],500);
        }
    }

    public function login(LoginRequest $request)
    {
        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
            $user = Auth::user();

            $token = $user->createToken($user->email.'-'.now());

            return response()->json([
                'token' => $token->accessToken
            ]);
        }
        else{
            return response()->json([
                'message' => 'Credentials Do Not Match. Please check the email and password',
            ],404);
        }
    }
}
