<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class Usercontroller extends Controller
{
    public function user(){
        return Auth::user();
    }
}
