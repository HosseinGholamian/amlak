<?php

namespace App\Http\Controllers\Admin;


use App\Ads;
use App\Category;
use App\Gallery;
use App\Http\Requests\Admin\AdsReqeust;
use App\Http\Requests\Admin\GalleryRequest;
use App\Http\Services\ImageUpload;
use System\Auth\Auth;


class AdsController extends AdminController
{



    public function index()
    {
        $ads = Ads::all();
        return view("admin.ads.index", compact("ads"));
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.ads.create", compact("categories"));
    }

    public function store()
    {

        $request = new AdsReqeust();
        $inputs = $request->all();

        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        $inputs['view'] = 0;
        $path = 'images/ads/' . date('Y/M/d');
        $name = date('Y_M_d_H_i_s') . "_" . rand(10, 99);
        $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 499);

        Ads::create($inputs);

        redirect('admin/ads');
    }

    public function edit($id)
    {
        $ads = Ads::find($id);
        $categories = Category::all();
        return view("admin.ads.edit", compact("ads", "categories"));
    }

    public function update($id)
    {
        //Get request
        $request = new AdsReqeust();

        $inputs = $request->all();

        //Image
        $file = $request->file('image');

        if (!empty($file['tmp_name'])) {
            $path = 'images/ads/' . date('Y/M/d');
            $name = date('Y_M_d_H_i_s') . "_" . rand(10, 99);
            $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 800, 499);
        }

        $inputs['user_id'] = Auth::user()->id;
        $inputs['status'] = 0;
        //Update
        Ads::update(array_merge($inputs, ['id' => $id]));
        redirect('admin/ads/');
    }

    public function destroy($id)
    {
        Ads::delete($id);
        redirect('admin/ads');
    }

    public function gallery($id)
    {
        $advertise = Ads::find($id);
        $galleries = Gallery::where("advertise_id", $id)->get();
        view('admin.ads.gallery', compact("advertise", 'galleries'));
    }

    public function storeGalleryImage($id)
    {
        $request = new GalleryRequest();
        $inputs = $request->all();


        $path = 'images/ads/gallery' . date('Y/M/d');
        $name = date('Y_M_d_H_i_s') . "_" . rand(10, 99);
        $inputs['image'] = ImageUpload::UploadAndFitImage($request->file('image'), $path, $name, 730, 400);

        $inputs['advertise_id'] = $id;

        Gallery::create($inputs);


        redirect('admin/ads/gallery/' . $id);
    }

    public function deleteGalleryImage($id)
    {
        Gallery::delete($id);
        back();
    }
}
