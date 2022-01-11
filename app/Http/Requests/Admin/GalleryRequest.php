<?php



namespace App\Http\Requests\Admin;

use \System\Request\Request;
class GalleryRequest extends Request
{
    public function rules(){
        return [
            'image' => 'file|mimes:png,jpeg,jpg|max:5000',
        ];
    }
}