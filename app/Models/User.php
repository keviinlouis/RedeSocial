<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        return $this->hasMany('App\Models\Post', 'user_id');
    }

    public function followers(){
        return $this->belongsToMany('App\Models\User', 'user_follows', 'followed_id');
    }

    public function following(){
        return $this->belongsToMany('App\Models\User', 'user_follows', 'following_id');
    }

    public function followingPosts(){
        return $this->following()->with($this->posts());
    }
}
