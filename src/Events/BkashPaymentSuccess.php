<?php

namespace Polashmahmud\Bkash\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BkashPaymentSuccess
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $response;
    public $query;

    /**
     * Create a new event instance.
     */
    public function __construct($response, $query)
    {
        $this->response = $response;
        $this->query = $query;
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
