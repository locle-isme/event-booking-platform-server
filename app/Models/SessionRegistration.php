<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionRegistration extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'session_registrations';
}
