<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Tweet extends Authenticatable
{
    //
    use Notifiable;

    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'body',
    ];

    /**
     * 配列には含めない属性
     *
     * @var array
     */
//    protected $hidden = [
//        'password',
//        'remember_token',
//    ];
}
