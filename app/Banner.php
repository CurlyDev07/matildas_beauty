<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = [];

    public function getImgAttribute($img){
        return config('app.cloudfront').$img;
    }
}
