<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $event = $this->route('event');
        return [
            'name' => 'required',
            'slug' => [
                'required',
                'regex:/^[a-zA-Z0-9-]+$/',
                Rule::unique('events')->where(function ($query) {
                    return $query->where('organizer_id', Auth::user()->id);
                })->ignore($event->id, 'id')
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
