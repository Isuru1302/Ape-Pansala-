<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{

    public function loginCheck(Request $request){

        $userName = $request->input('username');
        $password = $request->input('password');

        if($userName==="Admin" or $userName ==="email@gmail.com"){

            if($password==="12345678"){
                $status = true;
            }else{
                $status = false;
            }

        }else{
            $status = false;
        }

        return response()->json(['login_message'=>$status],201);
    }

}
