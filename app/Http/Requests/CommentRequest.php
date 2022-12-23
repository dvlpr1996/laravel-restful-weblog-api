<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => ['required', 'string', 'max:256'],
            'author' => ['required', 'string', 'max:64'],
            'email' => ['required', 'email'],
            'reply_of' => ['nullable', 'string']
        ];
    }
}
