<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\SlideRequest;
use App\Slide;
use \System\Auth\Auth;
use App\Http\Services\ImageUpload;

class SlideController extends AdminController
{
    public function index()
    {
        $slides = Slide::all();
        view('admin.slide.index', compact('slides'));
    }
    public function create()
    {
        return view('admin.slide.create');
    }
    public function store()
    {
        $request = new SlideRequest();
        $inputs = $request->all();

        
        

        $path = 'images/slides/' . date('Y/M/d');
        $name = date('Y_M_d_H_i_s') . "_" . rand(10, 99);
        $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 499);
        Slide::create($inputs);

        redirect('admin/slide/');
    }
    public function edit($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.edit', compact('slide'));
    }
    public function update($id)
    {
        //Get request
        $request = new SlideRequest();
        $inputs = $request->all();

        //Image
        $file = $request->file('image');
        if (!empty($file['tmp_name'])) {
            $path = 'images/posts/' . date('Y/M/d');
            $name = date('Y_M_d_H_i_s') . "_" . rand(10, 99);
            $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 499);
        }

        
        //Update
        Slide::update(array_merge($inputs, ['id' => $id]));
        redirect('admin/slide/');
    }
    public function destroy($id)
    {
        Slide::delete($id);
        redirect('admin/slide/');
    }
}
