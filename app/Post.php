<?php

namespace App;


use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;


class Post extends Model
{

    use HasSoftDelete;

    protected $table = 'posts';
    protected $fillable = ['title', 'body', 'image', 'user_id', 'cat_id','status','published_at'];
    protected $deletedAt = 'deleted_at';
    protected $casts = ['image' => 'array'];

    public function parentCat()
    {
        return $this->belongsTo('\App\Category', 'cat_id', 'id');
    }
    public function parentUser()
    {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }
    public function childComment()
    {
        return $this->hasMany('\App\Comment', 'post_id', 'id');
    }
    
}
