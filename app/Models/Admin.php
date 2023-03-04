<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'admins';
    protected $rememberTokenName = false;
    protected $guard = 'admin';

    public function getAuthPassword()
    {
        return $this->getAttribute('password');
    }
}
