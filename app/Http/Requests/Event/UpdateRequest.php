<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        $event = $this->route('event');
        return $event->organizer->id == Auth::user()->getAuthIdentifier();
    }

    public function rules()
        {
            $event = $this->route('event');
            return [
                'name' => 'required',
                'slug' => [
                    'required',
                    'regex:/^[a-zA-Z0-9-]+$/',
                    Rule::unique('events')->where(function ($query) {
                        return $query->where('organizer_id', Auth::user()->getAuthIdentifier());
                    })->ignore($event->id, 'id')
                ],
                'date' => 'required|date_format:m-d-Y|after:tomorrow'
            ];
        }

        public function messages()
        {
            return [
                'slug.regex' => "Slug must not be empty and only contain a-z, 0-9 and '-'",
                'slug.unique' => "Slug is already used"
            ];
        }
}
