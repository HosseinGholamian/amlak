<?php
namespace App;

use System\Database\ORM\Model;


class Comment extends Model
{

    protected $table = "comments";
    protected $fillable = ['user_id', 'post_id','parent_id','comment','status','approved'];
 

    public function parentUser(){
        return $this->belongsTo('\App\User' , 'user_id' , 'id');
    }

    public function childComment(){
        return $this->hasMany('\App\Comment' , 'parent_id' , 'id');
    }
}
