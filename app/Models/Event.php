<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'events';

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function registrations()
    {
        return $this->hasManyThrough(Registration::class, Ticket::class);
    }

    public function rooms()
    {
        return $this->hasManyThrough(Room::class, Channel::class);
    }

    public function isAvailable()
    {
        return $this->getAttribute('date') > date('Y-m-d') || $this->getAttribute('active') == 1;
    }

    public function getSessionsAttribute()
    {
        $rooms = $this->getAttribute('rooms');
        return $rooms->map(function (Room $room) {
            return $room->getNewFormatSessions();
        })->collapse()->sortBy('start')->values();
    }


    public static function isAlready(Event $event): bool
    {
        try {
            $availableTickets = $event->tickets()->count();
            $availableChannels = $event->channels()->count();
            return $availableChannels || $availableTickets;
        } catch (\Throwable $e) {
            return false;
        }
    }
}
