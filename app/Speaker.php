<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $guarded = [];
    protected $table = 'speakers';
    public $timestamps = false;

    public function sessionSpeakers()
    {
        return $this->hasMany(SessionSpeaker::class);
    }
}
