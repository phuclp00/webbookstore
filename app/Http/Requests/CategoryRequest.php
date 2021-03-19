<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'cat_id' => 'required|string|size:5',
            'cat_name' => 'required|string',
            'content'=>'required|string|',
        ];
    }
    public function messages()
    {
        return [
            
        ];
    }
}
