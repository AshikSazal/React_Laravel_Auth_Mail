<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function login(Request $req){
        try{
            if(Auth::attempt($req->only('email','password'))){
                $user = Auth::user();
                $token = $user->createToken('app')->plainTextToken;      
                return response([
                    'message'=>'Succesfully login',
                    'token'=>$token,
                    'user'=>$user
                ],200);
            }
        }catch(Exception $exception){
            return response(['message'=> $exception->getMessage()], 400);
        }

        return response([
            'message'=>'Invalid email or password'
        ], 401);
    }

    public function registration(RegisterRequest $req){
        try{
            $user = User::create([
                'name'=>$req->name,
                'email'=> $req->email,
                'password'=>Hash::make($req->password)
            ]);
            $token = $user->createToken('app')->plainTextToken;
            return response([
                'message'=>'Registration Successfull',
                'token'=>$token,
                'user'=>$user
            ], 200);
        }catch(Exception $exception){
            return response(['message'=> $exception->getMessage()], 400);
        }
    }

    public function logout(Request $req){
        $user = User::findOrFail($req->id);
        $user->tokens()->delete();
    }
}
