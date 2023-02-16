<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];
    protected $table = 'events';
    public $timestamps = false;

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
        return $this->hasManyThrough(Registration::class,Ticket::class);
    }

    public function rooms()
    {
        return $this->hasManyThrough(Room::class,Channel::class);
    }

    public function isAvailable(){
        return $this->date > date('Y-m-d') || $this->active == 1;
    }
}
