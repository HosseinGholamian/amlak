<?php

namespace App\Http\Requests\Auth;


use System\Request\Request;



class ForgotRequest extends Request{

    protected function rules(){
        return[
            'email'=>'email|required|max:100|exists:users,email',         
        ];
    }
}