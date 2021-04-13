<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionSpeakers extends Model
{
    //
    protected $guarded = [];
    public $timestamps = false;

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function speaker()
    {
        return $this->belongsTo(Speakers::class);
    }
}
