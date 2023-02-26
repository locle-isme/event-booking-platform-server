<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected $guards = [];

    public function handle($request, Closure $next, ...$guards)
    {
        $this->guards = $guards;
        $this->authenticate($request, $guards);
        return $next($request);
    }

    protected function redirectTo($request)
    {
        $guard = reset($this->guards);
        if (!empty($guard)) {
            return route("$guard.login");
        }
        return route('login');
    }

}
