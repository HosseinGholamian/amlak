<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\PostRequest;
use App\Post;
use \System\Auth\Auth;
use App\Category;
use App\Http\Services\ImageUpload;

class PostController extends AdminController
{
    public function index()
    {
        $posts = Post::all();
        view('admin.post.index', compact('posts'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }
    public function store()
    {
        $request = new PostRequest();
        $inputs = $request->all();

        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;

        $path = 'images/posts/' . date('Y/M/d');
        $name = date('Y_M_d_H_i_s') . "_" . rand(10, 99);
        $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 499);
        Post::create($inputs);

        redirect('admin/post/');
    }
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.post.edit', compact('post', 'categories'));
    }
    public function update($id)
    {
        //Get request
        $request = new PostRequest();
        $inputs = $request->all();

        //Image
        $file = $request->file('image');
        if (!empty($file['tmp_name'])) {
            $path = 'images/posts/' . date('Y/M/d');
            $name = date('Y_M_d_H_i_s') . "_" . rand(10, 99);
            $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 499);
        }

        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        
        //Update
        Post::update(array_merge($inputs, ['id' => $id]));
        redirect('admin/post/');
    }
    public function destroy($id)
    {
        Post::delete($id);
        redirect('admin/post/');
    }
}
