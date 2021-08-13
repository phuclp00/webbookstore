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
            'book_id' => ['required', 'regex:/^([A-Za-z0-9]{1,})*$/', 'max:15'],
            'book_name' => ['required', 'not_regex:/[\s]{2,}|^[\s]/', 'max:150'],
            'code' => ['required', 'numeric', 'digits:13'],
            'episode' => 'sometimes|numeric|between:1,9999',
            'cat_id' => 'required',
            'pub_id' => 'required',
            'weight' => 'required|numeric|min:0|max:5000',
            'author.*' => 'required',
            'series' => ['sometimes', 'required_without:new_series'],
            'new_series' => ['sometimes', 'nullable', 'required_without:series', 'not_regex:/[\s]{2,}|^[\s]/', 'unique:book_series,name', 'max:100'],
            'format' => 'required',
            'translator' => 'sometimes',
            'page_number' => 'required|numeric|min:0|max:5000',
            'date_published' => 'required|date_format:Y-m-d',
            'copyright' => ['required', 'numeric', 'min:0', 'max:9999'],
            'language' => 'required',
            'total' => 'required|numeric|min:0|max:99999',
            'img' => ['sometimes', 'image', 'max:10240 '],
            'thumb' => ['sometimes'],
            'thumb.*' => ['image', 'image', 'max:10240'],
            'size_width' => 'required|numeric|min:0|max:100',
            'size_height' => 'required|numeric|min:0|max:100',
            'price' => 'required|numeric|min:0|max:9999999',
            'promotion' => 'sometimes',
            'content' => ['required'],
        ];
        return $rules;
    }
    public function messages()
    {
        return [];
    }
}
