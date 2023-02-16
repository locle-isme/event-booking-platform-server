<?php

namespace App\Http\Requests\Event;

use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateRequest extends StoreRequest
{
    public function authorize()
    {
        $event = $this->route('event');
        return $event->organizer->id == Auth::user()->getAuthIdentifier();
    }

    public function rules()
    {
        $event = $this->route('event');
        return $this->getValidateRules($event);
    }
}
