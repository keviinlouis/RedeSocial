<?php

namespace App\Models;

use Auth;
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
        return $this->belongsToMany('App\Models\User', 'user_follows', 'followed_id','following_id');
    }

    public function following(){
        return $this->belongsToMany('App\Models\User', 'user_follows', 'following_id', 'followed_id');
    }

    public function followingPosts($between){
        $post = new Post();

        $ids =  $this->following()->pluck('id')->toArray();
        $ids[count($ids)] = Auth::user()->id;

        $posts = $post
            ->whereIn('user_id', $ids)
            ->whereBetween("created_at", $between)
            ->orderBy('created_at', 'desc')
            ->get();

        if(count($posts) <= 10){

            $posts = $post
                ->whereIn('user_id', $ids)
                ->where("created_at", "<", $between[0])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();


        }

        return $posts;
    }
}
