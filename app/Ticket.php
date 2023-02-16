<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = 'event_tickets';

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
        try {
            $sv = $this->getAttribute('special_validity');
            if (empty($sv)) {
                return [];
            }
            return json_decode($this->getAttribute('special_validity'), true);
        } catch (\Throwable $e) {
            return [];
        }
    }

    public function getDescriptionAttribute(): ?string
    {
        $result = $this->getSV();
        if (!$result) return null;
        if ($result['type'] == 'date') {
            $dateTime = date('F j, Y', strtotime($result['date']));
            return "Available until $dateTime";
        }
        if ($result['type'] == 'amount') {
            $amount = $result['amount'];
            return "$amount tickets available";
        }
        return null;
    }

    public function isAvailable(): bool
    {
        $result = @$this->getSV();
        if (empty($result)) {
            return true;
        }
        $registerCount = $this->registrations()->count();
        if ($result['type'] == 'amount' && $registerCount >= $result['amount']) {
            return false;
        }
        if ($result['type'] == 'date' && $result['date'] < date('Y-m-d')) {
            return false;
        }
        return true;
    }
}
