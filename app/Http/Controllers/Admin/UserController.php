<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserRequest;
use App\User;
use \System\Auth\Auth;
use App\Http\Services\ImageUpload;

class UserController extends AdminController
{
    public function index()
    {
        $users = User::all();
        view('admin.user.index', compact('users'));
    }
  
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update($id)
    {
        //Get request
        $request = new UserRequest();
        $inputs = $request->all();

        $updatable = ['first_name', 'last_name'];
        $inputs = array_intersect_key($inputs,array_flip($updatable));

        //Image
        $file = $request->file('avatar');

        if (!empty($file['tmp_name'])) {
            
            $path = 'images/users/' . date('Y/M/d');
            $name = date('Y_M_d_H_i_s') . "_" . rand(10, 99);
            $inputs['avatar'] = ImageUpload::UploadAndFitImage($request->file('avatar'), $path, $name, 100, 100);
        }
        
        //Update
        User::update(array_merge($inputs, ['id' => $id]));
        redirect('admin/user/');
    }

    public function userActive($id){
        $user = User::find($id);

        if($user->is_active == 0){
            User::update(['is_active' => 1 , 'id' =>$id]);
        }else{
            User::update(['is_active' => 0 , 'id' =>$id]);
        }

        return back();
    }
   

}
