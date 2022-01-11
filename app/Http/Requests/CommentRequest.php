<?php


namespace App\Http\Requestss;

use \System\Request\Request;

class CommentRequest extends Request
{
    public function rules()
    {
        return [
            'comment' => 'required',
           
        ];
    }
}
