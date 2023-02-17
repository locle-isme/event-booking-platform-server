<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = [];
    protected $table = 'rooms';
    public $timestamps = false;

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function sessions()
    {
        return $this->hasMany(Session::class);
    }

    public function getNewFormatSessions()
    {
        return $this->getAttribute('sessions')->map(function (Session $session) {
            return $session->getNewFormat();
        });
    }

    public static function isAlready(Room $room): bool
    {
        return (bool)$room->sessions()->count();
    }

    public static function isRoomValidate(Room $room, $data = [], $session = null)
    {
        return $room->getAttribute('sessions')->every(function ($s) use ($data, $session) {
            return Session::isAvailable($s, $data, $session);
        });
    }
}
