<?php

namespace App\Http\Requests\Auth;


use System\Request\Request;



class RegisterRequest extends Request{

    protected function rules(){
        return[
            'email'=>'email|required|max:100|unique:users,email',
            'first_name' => 'required',
            'last_name' => 'required' ,
            'password' => 'min:8|confirmed|required',
            'avatar' => 'file|required|max:3000|mimes:jpg,jpeg,png'
        ];
    }
}