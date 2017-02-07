<?php

use App\Conversation;

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

Broadcast::channel('channel.{conversationId}', function ($user, $conversationId) {
    $conversation = Conversation::find($conversationId);
    return $user->id == $conversation->user1_id || $user->id == $conversation->user2_id;
});