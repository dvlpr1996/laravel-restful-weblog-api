<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'title' => ['nullable', 'string', 'max:128','unique:posts'],
            'summary' => ['nullable', 'string', 'max:128'],
            'category_id' => ['nullable', Rule::in(['1', '2', '3', '4'])],
            'tags' => ['nullable', 'string'],
            'image' => ['nullable', 'file', 'min:1', 'max:1024', 'mimes:jpeg,jpg']
        ];
    }
}
