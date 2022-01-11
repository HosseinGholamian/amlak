<?php

namespace App\Http\Controllers\Auth;


use App\Http\Requests\Auth\ResetPasswordRequest;
use App\User;
use App\Http\Services\ImageUpload;
use App\Http\Services\MailService;
use System\Auth\Auth;


class ResetPasswordController
{
    private $redirectTo = '/login';

    public function view($token)
    {
        $user = User::where("remember_token" , $token)->where("remember_token_expire",'>=' ,date("Y-m-d H:i:s"))->get();
        if(empty($user)){
            return die("لینک بازیابی اعتبار ندارد");
        }
        $user = $user[0];

        view('auth.reset-password' , compact("token"));
    }
    public function resetPassword($token){   
        $request = new ResetPasswordRequest();
        $inputs = $request->all();

        $user = User::where("remember_token" , $token)->where("remember_token_expire",'>=' ,date("Y-m-d H:i:s"))->get();
        if(empty($user)){
            error("reset-password", "user not exists");
            return back();
        }
        
        if($inputs['password'] != $inputs['new_password']){
            error("reset-password", "پسورد های وارد شده مطاقبت ندارد");
            return back();
        }

        $user = $user[0];

        $user->password = password_hash($inputs['password'] , PASSWORD_DEFAULT);
        $user->save();
        return redirect($this->redirectTo);


    }
}
