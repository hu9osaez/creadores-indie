<?php namespace CreadoresIndie\Events;

use CreadoresIndie\Models\Reply;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

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
