<?php
namespace App\Http\Requests\Admin;

use \System\Request\Request;

class SlideRequest extends Request{

    public function rules(){
        if (methodField() == 'put') {
        return [
            'title' => 'required|max:191',
            'url' => 'required|max:191',
            'image' => 'file|mimes:png,jpeg,jpg|max:5000|min:100',
            'address' => 'required|max:191',
            'body' => 'required',
            'amount' => 'required|max:191'
        ];
    }
    else{
        return [
            'title' => 'required|max:191',
            'url' => 'required|max:191',
            'image' => 'file|mimes:png,jpeg,jpg|max:5000|min:100|required',
            'address' => 'required|max:191',
            'body' => 'required',
            'amount' => 'required|max:191'
        ];
    }
    }
}