<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
