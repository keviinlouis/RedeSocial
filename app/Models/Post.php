<?php

namespace App\Models;

use App\Scopes\CountPostsScope;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $likes
 * @property-read \App\Models\User $user
 * @mixin \Eloquent
 */
class Post extends Model
{
    protected $table = "posts";

    protected $primaryKey = "id";

    protected $fillable = [
        "text", "user_id"
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function reposts(){
        return $this->belongsToMany('App\Models\User', 'reposts', 'post_id', 'user_id')->withTimestamps();
    }
    public function respotable()
    {
        return $this->morphTo();
    }

    public function participants()
    {
        return $this->morphMany(Participant::class, 'participatable');
    }
    public function likes(){
        return $this->belongsToMany('App\Models\User', 'post_likes', 'post_id')->withTimestamps();
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment', 'post_id');
    }
}
