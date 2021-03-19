<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules= [
            'book_id' => 'required|string',
            'book_name' => 'required|string',
            'cat_id' => 'required',
            'pub_id' => 'required',
            'img' => ['mimes:jpg,bmp,png'],
            'thumb' => ['required','image','mimes:jpg,bmp,png','max:10240'],
            'thumb'=>['array','size:7'],
            'price' => 'required|numeric|gt:promotion',
            'promotion' => ['numeric'],
            'content' => 'required|string',
        ];
        return $rules;
    }
    public function messages()
    {
        return [
            
        ];
    }
}
