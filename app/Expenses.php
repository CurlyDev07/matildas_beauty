<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
Use App\ExpensesCategory;
class Expenses extends Model
{
    protected $guarded = [];

    public function category(){
        return $this->hasOne(ExpensesCategory::class, 'id', 'category_id');
    }
}
