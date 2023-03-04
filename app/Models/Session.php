<?php

namespace App\Models;

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

    public static function isAvailable(Session $session, $data = [], $cCession = null): bool
    {
        $currentId = @$cCession['id'];
        return $data['end'] < $session['start'] || $data['start'] > $session['end'] || $currentId == $session['id'];
    }

    public static function isAlready(Session $session): bool
    {
        return (bool)$session->sessionRegistrations()->count();
    }

    public function removeOldSpeakers()
    {
        try {
            if (empty($this->id)) {
                return 0;
            }
            $sessionSpeakers = $this->getAttribute('sessionSpeakers');
            foreach ($sessionSpeakers as $sessionSpeaker) {
                $sessionSpeaker->delete();
            }
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }

    public function addNewSpeakers($speakerIds)
    {
        try {
            if (empty($this->id)) {
                return 0;
            }
            foreach ($speakerIds as $speakerId) {
                $data = ['speaker_id' => $speakerId];
                $this->sessionSpeakers()->create($data);
            }
            return 1;
        } catch (\Throwable $e) {
            return 0;
        }
    }
}
