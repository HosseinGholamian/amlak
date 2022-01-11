<?php

namespace App\Http\Requests\Admin;

use System\Request\Request;

class PostRequest extends Request
{
    public function rules()
    {
        if (methodField() == 'put') {
            return [
                'title' => 'required|max:255',
                'published_at' => 'required|date',
                'image' => 'file|mimes:png,jpeg,jpg|max:5000|min:100',
                'cat_id' => 'required|exists:categories,id',
                'body' => 'required'
            ];
        } else {
            return [
                'title' => 'required|max:255',
                'published_at' => 'required|date',
                'image' => 'file|required|mimes:png,jpeg,jpg|max:800|min:100',
                'cat_id' => 'required|exists:categories,id',
                'body' => 'required'
            ];
        }
    }
}
