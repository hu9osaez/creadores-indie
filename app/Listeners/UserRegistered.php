<?php namespace CreadoresIndie\Listeners;

use Illuminate\Auth\Events\Registered;
use Spatie\Referer\Referer;

class UserRegistered
{
    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $user = auth()->user();
        $user_agent_parser = userAgentData();
        $referer = app(Referer::class)->get();

        activity()
            ->performedOn($event->user)
            ->causedBy($user)
            ->withProperties([
                'referer' => $referer,
                'ip_address' => getRequestIpAddress(),
                'user_agent' => getRequestUserAgent(),
                'country' => getRequestCountry(),
                'device'  => $user_agent_parser->device->model ?? 'unknown',
                'os' => optional($user_agent_parser->os)->toString() ?? 'unknown',
                'browser_name' => $user_agent_parser->browser->name ?? 'unknown',
                'browser_version' => optional($user_agent_parser->browser->version)->toString() ?? 'unknown',
            ])
            ->log('user_registered');
    }
}
