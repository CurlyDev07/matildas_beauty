<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'img', 'size', 'primary'];
    public $timestamps = false;

    public function getImgAttribute($img){
        return config('app.cloudfront').$img;
    }
}
