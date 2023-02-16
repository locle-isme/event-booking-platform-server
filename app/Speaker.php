<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'speakers';

    public function sessionSpeakers()
    {
        return $this->hasMany(SessionSpeaker::class);
    }
}
