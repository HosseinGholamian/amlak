<?php


namespace App\Http\Requests\Admin;


use System\Request\Request;

class UserRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                "first_name" => 'required|max:191',
                "last_name" => 'required|max:191',
                "avatar" => 'max:6048|mimes:jpg,jpeg,png|file',
            ];
        } else {
            return [
                "first_name" => 'required|max:191',
                "last_name" => 'required|max:191',
                "avatar" => 'max:2048|mimes:jpg,jpeg,png|file',
            ];
        }
    }
}
