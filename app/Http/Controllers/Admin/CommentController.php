<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\CommentRequest;
use App\Comment;
use System\Auth\Auth;

class CommentController extends AdminController
{



    public function index()
    {
        $comments = Comment::all();
        view('admin.comment.index', compact('comments'));
    }

    public function show($id){
        $comment = Comment::find($id);    
        view('admin.comment.show', compact('comment'));
    }

    public function approved($id){
        $comment = Comment::find($id);
        $approve = $comment->approved;

        if($approve == 1){
            Comment::update(['id'=>$id, 'approved' => 0]);
        }
        else{
            Comment::update(['id'=>$id, 'approved' => 1]);
        }

        return back();
    }


    public function answer($id){

        $comment = Comment::find($id);

        $requests = new CommentRequest();
        $inputs = $requests->all();

        $inputs['user_id'] = Auth::user()->id;
        $inputs['post_id'] = $comment->post_id;
        $inputs['parent_id'] = $id;
        $inputs['status'] = 0;
        $inputs['approved'] = 1;


        Comment::create($inputs);
        redirect('admin/comment');
    }
   
}
