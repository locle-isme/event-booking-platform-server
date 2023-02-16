<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Organizer extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    protected $table = 'organizers';
    protected $rememberTokenName = false;
    public $timestamps = false;

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }
}
