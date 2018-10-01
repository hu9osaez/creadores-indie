<?php namespace CreadoresIndie\Events;

use CreadoresIndie\Models\Reply;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ReplyWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Reply $reply
     */
    public $reply;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Reply $reply)
    {
        $this->reply = $reply;
    }
}
