<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ConversationService
{
    protected $user;



    public function doGet(): Collection
    {
        $user = Auth::user();
        return $user->conversations()->with('participants')->orderBy('created_at', 'desc')->get();
    }
    public function doStore(array $conversationData): Conversation
    {


        $conversation = self::checkIfConversationExist($conversationData['user_id']);
        if (!$conversation) {
            $conversation = Conversation::create([
                'type' => $conversationData['type'],
                'name' => $conversationData['name']
            ]);

            $conversation->participants()->attach([$conversationData['user_id'], Auth::user()->id]);
        }

        return $conversation;
    }

    private function checkIfConversationExist($userId1): ?Conversation
    {

        $user2Id = Auth::user()->id;

        return Conversation::whereHas('participants', function ($query) use ($userId1, $user2Id) {
            $query->where('user_id', $userId1)
                ->orWhere('user_id', $user2Id);
        }, '=', 2)
            ->where('type', 'one_to_one')
            ->first();
    }
}
