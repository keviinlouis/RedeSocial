<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = "messages";

    protected $guarded = ['id'];

    public function sender(){
        return $this->belongsTo('App\Models\User', 'sender_id');
    }
    public function receiver(){
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }
}
