<?php

namespace App\Models;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
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

    public function getJWTIdentifier()
    {
        return $this->getKey();
}

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function posts(){
        return $this->hasMany('App\Models\Post', 'user_id');
    }

    public function followers(){
        return $this->belongsToMany('App\Models\User', 'user_follows', 'followed_id','following_id');
    }

    public function following(){
        return $this->belongsToMany('App\Models\User', 'user_follows', 'following_id', 'followed_id');
    }

    public function followingPosts($start, $limit){
        $post = new Post();

        $ids =  $this->following()->pluck('id')->toArray();
        $ids[count($ids)] = Auth::user()->id;

        $posts = $post
            ->whereIn('user_id', $ids)
            ->orderBy('created_at', 'desc')
            ->with('user')
            ->withCount('likes')
            ->skip($start)
            ->take($limit)
            ->get();

        return $posts;
    }

    public function notFollowing(Array $id, $limit = 100){
        $actualUsers = Auth::user()->following()->pluck('id')->toArray();
        if(!is_null($id)){
            $actualUsers = $actualUsers + $id;
        }
        $actualUsers[count($actualUsers)] = Auth::user()->id;

        return $this->whereNotIn('id', $actualUsers)->limit($limit)->get();
    }

    public function follow($id){
        $this->following()->attach($id);
    }
    public function unfollow($id){
        $this->following()->detach($id);
    }
}
