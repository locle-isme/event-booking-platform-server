<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

trait MyAuthenticateUsers
{
    use AuthenticatesUsers;

    protected $usernameField = '';
    protected $guard = '';

    public function username(): string
    {
        return $this->usernameField;
    }

    public function showLoginForm()
    {
        $template = 'auth.login';
        if (!empty($this->guard)) {
            $template = "$this->guard.$template";
        }
        return view($template);
    }

    protected function guard()
    {
        return Auth::guard($this->guard);
    }

    protected function loggedOut(Request $request)
    {
        $route = 'login';
        if (!empty($this->guard)) {
            $route = "$this->guard.$route";
        }
        return redirect()->route($route);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        return $this->loggedOut($request) ?: redirect('/');
    }

    public function authenticated()
    {
        $route = 'home';
        if (!empty($this->guard)) {
            $route = "$this->guard.$route";
        }
        return Route::has($route) ? redirect()->route($route) : redirect('/');
    }
}
