<?php

namespace App\Http\Requests\Event;

use App\Event;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return $this->getValidateRules();
    }

    protected function getValidateRules($event = null): array
    {
        if ($event instanceof Event) {
            $uniqueSlug = Rule::unique('events')->where(function ($query) {
                return $query->where('organizer_id', Auth::user()->getAuthIdentifier());
            })->ignore($event->getAttribute('id'), 'id');
        } else {
            $uniqueSlug = Rule::unique('events')->where(function ($query) {
                return $query->where('organizer_id', Auth::user()->getAuthIdentifier());
            });
        }
        return [
            'name' => 'required',
            'slug' => [
                'required',
                'regex:/^[a-zA-Z0-9-]+$/',
                $uniqueSlug
            ],
            'date' => 'required|date_format:Y-m-d|after:tomorrow'
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
