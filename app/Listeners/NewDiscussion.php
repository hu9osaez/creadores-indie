<?php namespace CreadoresIndie\Listeners;

use CreadoresIndie\Events\DiscussionWasCreated;

class NewDiscussion
{
    /**
     * Handle the event.
     *
     * @param  DiscussionWasCreated  $event
     * @return void
     */
    public function handle(DiscussionWasCreated $event)
    {
        $user_agent_parser = userAgentData();

        activity()
            ->performedOn($event->discussion)
            ->causedBy($event->discussion->user)
            ->withProperties([
                'ip_address' => getRequestIpAddress(),
                'user_agent' => getRequestUserAgent(),
                'country' => getRequestCountry(),
                'device'  => $user_agent_parser->device->model ?? 'unknown',
                'os' => optional($user_agent_parser->os)->toString() ?? 'unknown',
                'browser_name' => $user_agent_parser->browser->name ?? 'unknown',
                'browser_version' => optional($user_agent_parser->browser->version)->toString() ?? 'unknown',
            ])
            ->log('discussion::new');
    }
}
