<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'body' => ['nullable', 'string'],
            'title' => ['nullable', 'string', 'max:128', Rule::unique('posts', 'title')
                ->ignore($this->post)],
            'summary' => ['nullable', 'string', 'max:128'],
            'category_id' => ['nullable', Rule::in(['1', '2', '3', '4'])],

            'tags' => ['nullable', 'string'],
            'image' => ['nullable', 'file', 'max:1024', 'mimes:jpeg,jpg'],
        ];
    }
}
