<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'attendees';

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
