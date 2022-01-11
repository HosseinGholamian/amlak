<?php

namespace App;

use System\Database\ORM\Model;
use System\Database\Traits\HasSoftDelete;

class Ads extends Model
{

    use HasSoftDelete;

    protected $table = 'ads';
    protected $fillable = [
        'title', 'description', 'address', 'amount', 'image',
        'floor', 'year', 'storeroom', 'balcony', 'area', 'room', 'toilet', 'parking',
        'tag', 'user_id', 'cat_id', 'status', 'sell_status', 'type', 'view',
        'created_at', 'updated_at'
    ];
    protected $casts = [];
    protected $deletedAt = 'deleted_at';


    public function childGalleries()
    {
        return $this->hasMany("\App\Gallery", 'advertise_id', 'id');
    }

    public function parentUser()
    {
        return $this->belongsTo("\App\User", "user_id", "id");
    }

    public function parentCat()
    {
        return $this->belongsTo("\App\Category", "cat_id", "id");
    }




public function sellStatus(){
    return $this->sell_status == 0 ? "اجاره" : "خرید" ; 
}

public function type(){
    switch ($this->type) {
        case '0':
            return "آپارتمان";
                   
        case '1':
            return "ویلایی";
            
        case '2':
            return "زمین";
            
        case '3':
            return "سوله";
    }


}


}
