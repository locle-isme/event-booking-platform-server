<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAuth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $event = $request->route('event');
        if ($event) {
            if ($event->organizer_id != Auth::user()->id) {
                abort('404');
            }
            if ($request->route('channel') && $request->route('channel')->event->id != $event->id) {
                abort('404');
            }
            if ($request->route('ticket') && $request->route('ticket')->event->id != $event->id) {
                abort('404');
            }
            if ($request->route('room') && $request->route('room')->channel->event->id != $event->id) {
                abort('404');
            }
            if ($request->route('session') && $request->route('session')->room->channel->event->id != $event->id) {
                abort('404');
            }
        }
        return $next($request);
    }
}
