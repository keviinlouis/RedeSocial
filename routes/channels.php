<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

use App\Models\Message;
use App\Models\User;

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('posts.{id}', function (User $user, $id) {
    return in_array($user->following()->pluck('id'), [$id])===true;
});

Broadcast::channel('message.{id}', function ($user, Message $message) {
    return $user->id === $message->receiver_id;
});
