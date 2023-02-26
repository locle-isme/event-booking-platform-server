<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MyAuthenticateUsers;

class LoginController extends Controller
{
    use MyAuthenticateUsers;

    public function __construct()
    {
        $this->guard = 'admin';
        $this->usernameField = 'username';
        $this->middleware('guest:admin')->except('logout');
    }
}
