<?php

namespace App\Events;

use App\Models\Journal;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class JournalProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $action;
    public $record;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Journal $journal,
        $action,
        $record,
    ) {
        $this->action = $action;
        $this->record = $record;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
