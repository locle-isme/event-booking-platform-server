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
        if ($event && $event->organizer_id != Auth::user()->id) {
            return abort('404');
        }
        return $next($request);
    }
}
