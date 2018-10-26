<?php namespace CreadoresIndie\Listeners;

use CreadoresIndie\Events\ReplyWasCreated;

class NewReply
{
    /**
     * Handle the event.
     *
     * @param  ReplyWasCreated  $event
     * @return void
     */
    public function handle(ReplyWasCreated $event)
    {
        $user_agent_parser = userAgentData();

        activity()
            ->performedOn($event->reply)
            ->causedBy($event->reply->user)
            ->withProperties([
                'ip_address' => getRequestIpAddress(),
                'user_agent' => getRequestUserAgent(),
                'country' => getRequestCountry(),
                'device'  => $user_agent_parser->device->model ?? 'unknown',
                'os' => optional($user_agent_parser->os)->toString() ?? 'unknown',
                'browser_name' => $user_agent_parser->browser->name ?? 'unknown',
                'browser_version' => optional($user_agent_parser->browser->version)->toString() ?? 'unknown',
            ])
            ->log('reply::new');
    }
}
