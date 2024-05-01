<?php

namespace App\Http\Controllers;

use App\Services\ConversationService;
use App\Services\MessageService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MessageController extends Controller
{
    protected $conversationService;
    protected $messageService;
    protected $userService;

    public function __construct(ConversationService $conversationService, MessageService $messageService, UserService $userService)
    {
        $this->conversationService = $conversationService;
        $this->messageService = $messageService;
        $this->userService = $userService;
    }
    public function index()
    {
        $conversations = $this->conversationService->doGet();
        $users = $this->userService->doGetUsers(Auth::user()->employee->company_id);
        return Inertia::render(
            'messages/index',
            [
                'conversations' => $conversations,
                'conversation_id' => $conversations[0]->id,
                'users' => $users->except(Auth::user()->id)
            ]
        );
    }

    public function store(Request $request)
    {
        $this->messageService->doSend($request->all());
    }

    public function show($conversationId)
    {
        $messages = $this->messageService->getMessages($conversationId);

        return response(json_encode($messages), 200);
    }
}
