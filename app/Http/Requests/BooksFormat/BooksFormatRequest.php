<?php

namespace App\Http\Requests\BooksFormat;

use Illuminate\Foundation\Http\FormRequest;

class BooksFormatRequest extends FormRequest
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
            'name' => ['required', 'unique:book_format,name', 'not_regex:/[\s]{2,}|^[\s]/]', 'max:255'],
            'img' => ['sometimes', 'image', 'max:10240 '],
            'content' => ['nullable', 'not_regex:/<\?php(.+?)\?>|<script\b[^>]*>[\s\S]*?<\/script\b[^>]*>/'],
        ];
    }
    public function messages()
    {
        return [];
    }
}
