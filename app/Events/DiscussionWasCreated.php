<?php namespace CreadoresIndie\Events;

use CreadoresIndie\Models\Discussion;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

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
