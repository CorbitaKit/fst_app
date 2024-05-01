<?php

namespace App\Http\Controllers;

use App\Services\ConversationService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ConversationController extends Controller
{
    protected $conversationService;
    public function __construct(ConversationService $conversationService)
    {
        $this->conversationService = $conversationService;
    }


    public function store(Request $request)
    {
        $conversation = $this->conversationService->doStore($request->all());
        return redirect()->route('messages.index');
    }
}
