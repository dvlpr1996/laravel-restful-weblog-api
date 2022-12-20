<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class WriterUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fname' => ['nullable', 'string'],
            'lname' => ['nullable', 'string'],
            'bio' => ['nullable', 'string'],
            'email' => ['nullable', 'string', 'email', Rule::unique('users', 'email')
                ->ignore(auth()->user()->id)],
        ];
    }
}
