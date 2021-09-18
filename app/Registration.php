<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $guarded = [];
    public $timestamps = false;


    public function attendee()
    {
        return $this->belongsTo(Event::class);
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function sessionRegistrations()
    {
        return $this->hasMany(SessionRegistration::class);
    }
}
