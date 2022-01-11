<?php

namespace App\Http\Controllers;

use App\Slide;
use App\Ads;
use App\Category;
use App\Post;
use App\Comment;
use System\Database\DBBuilder\DBBuilder;
use App\Http\Requests\Admin\CommentRequest;
use System\Auth\Auth;

class HomeController extends Controller
{
    public function index()
    {
        
        //$tables = new DBBuilder;

        $slides = Slide::all();
        $newestAds = Ads::orderBy('created_at' , 'desc')->limit(0,6)->get();
        $bestAds = Ads::orderBy('view' , 'desc')->orderBy('created_at' , 'desc')->limit(0,4)->get();
        $posts = Post::where('published_at','<=',date('Y-m-d H:i:s'))->orderBy('created_at' , 'desc')->limit(0,4)->get();
        return view('app.index' , compact("slides","newestAds","bestAds","posts"));

    }



    public function about(){
        return view('app.about');
    }


    public function ads($id){
       
        $advertise = Ads::find($id);
        $galleries = $advertise->childGalleries()->get();
        
        $posts = Post::where('published_at','<=',date('Y-m-d H:i:s'))->orderBy('created_at' , 'desc')->limit(0,4)->get();
        $relatedAds = Ads::where('cat_id',$advertise->cat_id)->where('id','!=',$id)->orderBy('created_at' , 'desc')->limit(0,2)->get();
        $categories = Category::all();

        return view('app.ads',compact("advertise","galleries","posts","relatedAds","categories"));
    }


    public function allAds(){
        $ads = Ads::all();
        return view('app.all-ads',compact("ads"));
    }
  
    public function allPost(){
        $posts = Post::where('published_at','<=',date('Y-m-d H:i:s'))->orderBy('published_at' , 'desc')->get();
        return view('app.all-posts',compact("posts"));
    }

    public function post($id){
        $post = Post::find($id);
        if(empty($post)){
            redirect("/notFound");
        }
        $comments = $post->childComment()->where("approved" , 1)->whereNull("parent_id")->orderBy('created_at','desc')->get();
        $categories = Category::all();
        $posts = Post::where('published_at','<=',date('Y-m-d H:i:s'))->orderBy('created_at' , 'desc')->limit(0,4)->get();
        return view('app.post',compact("post","posts","categories","comments"));
    }

    public function postComment($id){
        $request = new CommentRequest;
        $inputs = $request->all();
        $inputs["post_id"] = $id;
        $inputs['approved'] = 0;
        $inputs['status'] = 0;
        $inputs['user_id'] = Auth::user()->id;
        $comments = Comment::create($inputs);
        return back();
    }

    public function category($id){
        
        $posts = Post::where("cat_id",$id)->where('published_at','<=',date('Y-m-d H:i:s'))->orderBy('published_at' , 'desc')->get();
        return view('app.cat-post',compact("posts"));
    }

    public function search(){
        if(isset($_GET['search'])){
            $seaech = '%'. $_GET['search'] .'%';
            $ads = Ads::where("title","LIKE",$seaech)->where("deleted_at","NULL")->whereOr("tag","LIKE",$seaech)->get();
            $posts = Post::where("title","LIKE",$seaech)->get();
            return view('app.search',compact("posts","ads"));
        }
    }
}
