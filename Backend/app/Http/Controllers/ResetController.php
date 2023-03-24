<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetRequest;

class ResetController extends Controller
{
    public function resetpassword(ResetRequest $req){
        $email = $req->email;
        $token = $req->token;
        $password = Hash::make($req->password);
        
        $emailCheck = DB::table('password_reset_tokens')->where('email',$email)->first();
        $tokenCheck = DB::table('password_reset_tokens')->where('token',$token)->first();
        
        if(!$emailCheck){
            return response([
                'message'=>'Email Not found'
            ], 401);
        }
        if(!$tokenCheck){
            return response([
                'message'=>'Pin Code Invalid'
            ], 401);
        }
        DB::table('users')->where('email',$email)->update(['password'=>$password]);
        DB::table('password_reset_tokens')->where('email',$email)->delete();
        return response([
            'message'=>'Password Change Successfully'
        ], 200);
    }
}
