<?php

namespace App\Http\Requests\Promotions;

use Illuminate\Foundation\Http\FormRequest;

class PromotionsRequest extends FormRequest
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
            'name' => ['required', 'unique:promotions,name', 'not_regex:/[\s]{2,}|^[\s]/', 'unique:promotions'],
            'percent' => ['required', 'numeric', 'between:5,99'],
            'date_started' => ['required', 'date_format:"Y-m-d\TH:i"', 'after:' . now()],
            'date_expired' => ['required', 'date_format:"Y-m-d\TH:i"', 'after:date_started'],
            'content' => ['nullable', 'not_regex:/<\?php(.+?)\?>|<script\b[^>]*>[\s\S]*?<\/script\b[^>]*>/'],
        ];
    }
    public function messages()
    {
        return [];
    }
}
