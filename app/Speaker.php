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

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }


    public static function isAlready(Speaker $speaker)
    {
        return (bool)$speaker->sessionSpeakers()->count();
    }

    public function getAvatarAttribute($val): string
    {
        if (empty($val) || !file_exists($val)) {
            return config('constants.common.default_avatar_image');
        }
        return $val;
    }
}
