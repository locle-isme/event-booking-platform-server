<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionSpeaker extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'session_speakers';

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }
}
