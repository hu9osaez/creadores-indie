<?php namespace CreadoresIndie\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            abort(404);
        }

        /** @var \CreadoresIndie\Models\User $user */
        $user = auth()->user();

        abort_unless($user->isAn('admin'), 404);

        return $next($request);
    }
}
