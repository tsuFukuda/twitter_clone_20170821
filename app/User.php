<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * 複数代入を行う属性
     *
     * @var array
     */
    protected $fillable = [
        'url_name',
        'email',
        'password',
        'display_name',
        'avatar',
    ];

    /**
     * 配列には含めない属性
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roles()
    {
        return $this -> belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }
    public function following()
    {
        return $this -> belongsToMany('App\User', 'friendships', 'follower_id', 'followee_id');
    }
    public function followers()
    {
        return $this -> belongsToMany('App\User', 'friendships', 'followee_id', 'follower_id');
    }

}
