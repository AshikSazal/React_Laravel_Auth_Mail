<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ForgetRequest;
use App\Mail\ForgetMail;
use Illuminate\Support\Facades\Mail;

class ForgetController extends Controller
{
    public function forgetpassword(ForgetRequest $req){
        $email = $req->email;
        // check mail exists or not exists
        if(User::where('email',$email)->doesntExist()){
            return response([
                'message'=>'Email Invalid'
            ], 401);
        }
        $token = rand(10, 100000);
        try{
            DB::table('password_reset_tokens')->insert([
                'email'=>$email,
                'token'=>$token
            ]);

            // Mail send to User
            Mail::to($email)->send(new ForgetMail($token));

            return response([
                'message'=>'Reset Password Mail send on your email'
            ], 200);

        }catch(Exception $exception){
            return response(['message'=> $exception->getMessage()], 400);
        }
    }
}
