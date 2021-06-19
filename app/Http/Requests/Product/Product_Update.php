<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class Product_Update extends FormRequest
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
        $rules = [
            'book_id' => 'required',
            'book_name' => ['required', 'not_regex:/[\s]{2,}|^[\s]/', 'max:255'],
            'code' => ['required', 'numeric', 'digits:13'],
            'episode' => ['sometimes', 'numeric', 'min:1'],
            'cat_id' => 'required',
            'pub_id' => 'required',
            'weight' => ['required', 'numeric', 'min:0'],
            'author.*' => 'required',
            'series' => ['sometimes', 'required_without:new_series'],
            'new_series' => ['sometimes', 'required_without:series', 'nullable', 'not_regex:/[\s]{2,}|^[\s]/', 'unique:book_series,name', 'max:255'],
            'format' => 'required_without:new_format',
            'new_format' => ['nullable', 'required_without:format', 'not_regex:/[\s]{2,}|^[\s]/', 'unique:book_format,name', 'max:255'],
            'translator' => 'sometimes|required_without:new_translator',
            'new_translator' => ['sometimes', 'required_without:translator', 'not_regex:/[\s]{2,}|^[\s]/', 'unique:translator,name', 'max:255'],
            'page_number' => 'required|numeric|min:0',
            'date_published' => 'required|date_format:Y-m-d',
            'copyright' => ['required', 'numeric', 'min:0'],
            'language' => 'required',
            'total' => 'required|numeric|min:0',
            'img' => ['sometimes', 'image', 'max:10240 '],
            'thumb' => ['sometimes'],
            'thumb.*' => ['image', 'mimes:png,jpg,jpeg'],
            'size_width' => 'required|numeric|min:0',
            'size_height' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'promotion' => ['sometimes', 'numeric', 'min:0', 'lt:price'],
            'content' => ['required', 'not_regex:/<\?php(.+?)\?>|<script\b[^>]*>[\s\S]*?<\/script\b[^>]*>/'],
        ];
        return $rules;
    }
    public function messages()
    {
        return [];
    }
}
