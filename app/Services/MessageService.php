<?php

namespace App\Services;

use App\Events\ChatMessageSent;
use App\Models\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    public function doSend(array $messageData)
    {
        $message = Message::create([
            'user_id' => Auth::user()->id,
            'conversation_id' => $messageData['conversation_id'],
            'content' => $messageData['content']
        ]);

        event(new ChatMessageSent(Message::with('user')->where('id', $message->id)->first()));
    }

    public function getMessages(int $conversationId): Collection
    {
        return Message::where('conversation_id', $conversationId)
            ->with('user')
            ->get();
    }
}
