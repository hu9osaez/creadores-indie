<?php namespace CreadoresIndie\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class UserRegistered extends Notification
{
    use Queueable;

    /** @var \CreadoresIndie\Models\User */
    private $user;

    /**
     * Create a new notification instance.
     *
     * @var \CreadoresIndie\Models\User $user
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via()
    {
        return ['slack'];
    }

    public function toSlack()
    {
        return (new SlackMessage)
            ->success()
            ->content("Se ha registrado un nuevo usuario, {$this->user->username_public}!")
            ->attachment(function ($attachment) {
                $attachment->title($this->user->name . " ({$this->user->username_public})", $this->user->url);
            });
    }
}
