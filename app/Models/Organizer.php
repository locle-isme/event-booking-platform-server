<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Organizer extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'organizers';
    protected $rememberTokenName = false;

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function speakers()
    {
        return $this->hasMany(Speaker::class);
    }

    public function getAuthPassword()
    {
        return $this->getAttribute('password_hash');
    }
}
