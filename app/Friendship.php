<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Friendship extends Authenticatable
{
    //
    use Notifiable;

    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = [
        'follower_id',
        'followee_id',
        'created_at',
        'updated_at',
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
    public function tweets()
    {
        return $this->belongsToMany('App\Tweet');
    }
}
