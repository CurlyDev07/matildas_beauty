<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany(Transaction::class);
    }

    public function isMaster(){
        return $this->role == 'master'? true:false;
    }

    public function isSA(){
        return $this->role == 'sa'? true:false;
    }

    public function isInventory(){
        return $this->role == 'inventory'? true:false;
    }

     public function fbAds()
    {
        return $this->hasMany(FbAds::class, 'user_id');
    }
}
