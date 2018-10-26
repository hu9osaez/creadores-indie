<?php namespace CreadoresIndie\Listeners;

use Illuminate\Auth\Events\Login;
use Spatie\Referer\Referer;

class UserLoggedIn
{
    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
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
            ->log('auth::login');
    }
}
