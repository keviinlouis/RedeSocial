<?php

namespace App\Models;

use App\Scopes\CountPostsScope;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";

    protected $fillable = [
        "text", "user_id"
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function likes(){
        return $this->belongsToMany('App\Models\User', 'post_likes', 'post_id')->withTimestamps();
    }
}
