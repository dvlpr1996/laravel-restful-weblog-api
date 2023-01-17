<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => ['required', 'string'],
            'title' => ['required', 'string', 'max:128'],
            'summary' => ['required', 'string', 'max:128'],
            'category_id' => ['required', Rule::in(['1', '2', '3', '4'])],
            'tags' => ['required', 'string'],
            'image' => ['required', 'file', 'max:1024', 'mimes:jpeg,jpg']
        ];
    }
}
