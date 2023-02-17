<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'channels';

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function sessions()
    {
        return $this->hasManyThrough(Session::class, Room::class);
    }

    public static function isAlready(Channel $channel): bool
    {
        return (bool) $channel->rooms()->count();
    }
}
