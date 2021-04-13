<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    //
    protected $guarded = [];
    public $timestamps = false;

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function sessionRegistrations()
    {
        return $this->hasMany(SessionRegistration::class);
    }

    public function sessionSpeakers()
    {
        return $this->hasMany(SessionSpeaker::class);
    }
}
