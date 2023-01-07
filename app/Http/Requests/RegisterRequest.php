<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fname' => ['required', 'string', 'min:3', 'max:32'],
            'lname' => ['required', 'string', 'min:3', 'max:64'],
            'bio' => ['required', 'string', 'min:3', 'max:1024'],
            'email' => ['required', 'max:255', 'string', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'string',
                'max:64',
                'confirmed',
                // Password::min(6)->mixedCase()->letters()->numbers()->symbols()
                Password::default()
            ],
        ];
    }
}
