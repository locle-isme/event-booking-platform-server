<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionRegistration extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'session_registrations';
}
