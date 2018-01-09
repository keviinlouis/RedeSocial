<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\DB;

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
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

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

    public function posts()
    {
        return $this->hasMany('App\Models\Post', 'user_id');
    }

    public function reposts()
    {
        return $this->belongsToMany('App\Models\Post', 'reposts', 'user_id', 'post_id')
            ->withTimestamps();
    }

    public function allposts()
    {
        $select = ['*',
            'posts.user_id AS pivot_user_id',
            'posts.id AS pivot_post_id',
            'posts.created_at AS pivot_created_at',
            'posts.updated_at AS pivot_updated_at'
        ];
        $posts = $this->posts()->select($select);
        return $this->reposts()->union($posts)->orderByDesc('pivot_created_at')->with(["user"]);
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'user_id');
    }

    public function messagesReceived()
    {
        return $this->hasMany('App\Models\Message', 'receiver_id');
    }

    public function messagesSent()
    {
        return $this->hasMany('App\Models\Message', 'sender_id');
    }

    public function newMessages()
    {
        return $this->messagesReceived()->where('opened', '=', 0)->with('sender');
    }

    public function channel(User $user)
    {
        $sent = $this->messagesSent()->where('receiver_id', '=', $user->id);
        $messages = $user->messagesSent()
            ->where('receiver_id', '=', Auth::id())
            ->with(['sender', 'receiver'])
            ->union($sent)
            ->orderByDesc('created_at')->get();
        return $messages;
    }

    public function messages()
    {
        return $this->messagesReceived()->union($this->messagesSent());
    }

    public function likes()
    {
        return $this->belongsToMany('App\Models\Post', 'post_likes', 'user_id', 'post_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany('App\Models\User', 'user_follows', 'followed_id', 'following_id')->withTimestamps();
    }

    public function following()
    {
        return $this->belongsToMany('App\Models\User', 'user_follows', 'following_id', 'followed_id')->withTimestamps();
    }

    public function followingPosts($start, $limit)
    {
        $ids = $this->following()->pluck('id')->toArray();
        $ids[] = Auth::id();


        $posts = Post::whereIn('user_id', $ids)
            ->orderBy('created_at', 'desc')
            ->with(['user', 'comments'])
            ->withCount(['likes', 'comments'])
            ->skip($start)
            ->take($limit)
            ->get();

        return $posts;
    }

    public function notFollowing(Array $id, $limit = 100)
    {
        $actualUsers = Auth::user()->following()->pluck('id')->toArray();
        if (!is_null($id)) {
            $actualUsers = array_merge($actualUsers, $id);
        }
        $actualUsers[count($actualUsers)] = Auth::user()->id;

        return $this->whereNotIn('id', $actualUsers)->limit($limit)->get();
    }

}
