<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'link'];
    protected $hidden = ['created_at', 'updated_at'];

    public static function categories(){
        return self::all()->toArray();
    }
}

