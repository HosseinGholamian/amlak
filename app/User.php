<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class User extends Model
{


    use HasSoftDelete;

    protected $table = "users";
    protected $fillable = ['email','first_name','last_name', 'avatar' , 'password', 'status' , 'is_active' , 'user_type' , 'verify_token','remember_token','remember_token_expire'];
    protected $deletedAt = 'deleted_at';
    protected $casts = [];



}