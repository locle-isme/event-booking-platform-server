<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $table = "event_tickets";
    protected $guarded = [];
    public $timestamps = false;


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }




    public function getSV()
    {
        return json_decode($this->special_validity);
    }

    public function getDescription()
    {
        $result = $this->getSV();
        if ($result)
        {
            if ($result->type == 'date')
            {
                return "Available until ".date('F j, Y', strtotime($result->date));
            }

            if ($result->type == 'amount')
            {
                return $result->amount." tickets available";
            }
        }
        return null;
    }

    public function isAvailable()
    {
        $result = $this->getSV();
        if ($result) {
            //dd($result);
            if ($result->type == 'amount' && $this->registrations()->count() >= $result->amount)
            {
                return false;
            }

            if ($result->type == 'date' && $result->date < date('Y-m-d'))
            {
                return false;
            }
        }

        return true;
    }
}
