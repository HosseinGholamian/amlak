<?php

namespace App\Http\Requests\Auth;


use System\Request\Request;



class LoginRequest extends Request{

    protected function rules(){
        return[
            'email'=>'email|required|max:100',
            'password' => 'required',
           
        ];
    }
}