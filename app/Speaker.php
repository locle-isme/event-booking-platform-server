<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function sessionSpeakers()
    {
        return $this->hasMany(SessionSpeaker::class);
    }
}
