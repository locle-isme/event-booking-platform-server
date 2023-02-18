<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Attendee extends Authenticatable implements JWTSubject
{
    use Notifiable;
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'attendees';

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
