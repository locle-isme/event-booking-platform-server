<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $guarded = [];
    protected $table = 'sessions';
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

    public function getChannelRoomAttribute()
    {
        $room = $this->getAttribute('room');
        return $room->channel->name . ' / ' . $room->name;
    }

    public function getNewFormat()
    {
        $this->channel_room = $this->getChannelRoomAttribute();
        $this->start = date('H:i', strtotime($this->getAttribute('start')));
        $this->end = date('H:i', strtotime($this->getAttribute('end')));
        $speakers = $this->getAttribute('sessionSpeakers')->map(function ($sessionSpeaker) {
            return $sessionSpeaker->speaker->name;
        })->toArray();
        $this->speakers = implode(", ", $speakers);
        return $this;
    }
}
