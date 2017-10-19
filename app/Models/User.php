<?php

namespace App\Models;

use Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $following
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $likes
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Post[] $posts
 * @mixin \Eloquent
 */
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

    public function reposts(){
        return $this->belongsToMany('App\Models\Post', 'reposts', 'user_id', 'post_id')->withTimestamps()->orderBy('created_at', 'desc');
    }
    public function allPosts()
    {
        return $this->morphToMany('App\Models\AllPosts', 'all');
    }

    public function getAll(){

        $posts = $this->posts()->with('user')->get();
        $reposts = $this->reposts()->with('user')->get();
        $all = new AllPosts();
        dd($this->allPosts());
        return $posts->merge($reposts);
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment', 'user_id');
    }

    public function likes(){
        return $this->belongsToMany('App\Models\Post', 'post_likes', 'user_id', 'post_id')->withTimestamps();
    }

    public function followers(){
        return $this->belongsToMany('App\Models\User', 'user_follows', 'followed_id','following_id')->withTimestamps();
    }

    public function following(){
        return $this->belongsToMany('App\Models\User', 'user_follows', 'following_id', 'followed_id')->withTimestamps();
    }

    public function followingPosts($start, $limit){
        $ids = $this->following()->pluck('id')->toArray() + [Auth::user()->id];

        $posts = Post::whereIn('user_id', $ids)
            ->orderBy('created_at', 'desc')
            ->with(['user', 'comments'])
            ->withCount(['likes', 'comments'])
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

}
