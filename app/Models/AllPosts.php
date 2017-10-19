<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
    * @mixin \Eloquent
 *
 */
class AllPosts extends Model
{
    /**
     * Get all of the users that are assigned to this Competition.
     */
    public function posts()
    {
        return $this->morphMany('App\Models\Post', 'postable');
    }

    /**
     * Get all of the Teams that are assigned to this Competition.
     */
    public function reposts()
    {
        return $this->morphedByMany('App\Models\Post', 'postable');
    }
}