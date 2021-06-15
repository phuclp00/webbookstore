<?php

namespace App\Http\Requests\BooksType;

use Illuminate\Foundation\Http\FormRequest;

class BooksType_Update extends FormRequest
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
        return [
            'name' => 'required',
            'img' => ['sometimes', 'image', 'max:10240 '],
            'content' => ['required', 'not_regex:/<\?php(.+?)\?>|<script\b[^>]*>[\s\S]*?<\/script\b[^>]*>/'],
        ];
    }
    public function messages()
    {
        return [];
    }
}
