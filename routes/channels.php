<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;
use App\Models\Message;
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

Broadcast::channel('message-sent', function () {
    return true;
});

Broadcast::channel('messageSent', function () {
    return true;
});
