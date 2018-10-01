<?php namespace CreadoresIndie\Events;

use CreadoresIndie\Models\Discussion;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class DiscussionWasCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Discussion $discussion
     */
    public $discussion;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Discussion $discussion)
    {
        $this->discussion = $discussion;
    }
}
