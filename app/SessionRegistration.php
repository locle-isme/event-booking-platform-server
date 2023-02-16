<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionRegistration extends Model
{
    protected $guarded = [];
    protected $table = 'session_registrations';
    public $timestamps = false;
}
