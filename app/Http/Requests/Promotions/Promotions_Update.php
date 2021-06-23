<?php

namespace App\Http\Requests\Promotions;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class Promotions_Update extends FormRequest
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
        $current_date = Carbon::now()->format('Y-m-d\TH:i');
        return [
            'id' => 'required',
            'name' => ['required', 'not_regex:/[\s]{2,}|^[\s]/'],
            'percent' => ['required', 'numeric', 'between:5,99'],
            'date_expired' => ['required', 'date_format:"Y-m-d\TH:i"', 'after:date_format:"H:i"'],
            'content' => ['nullable', 'not_regex:/<\?php(.+?)\?>|<script\b[^>]*>[\s\S]*?<\/script\b[^>]*>/'],
        ];
    }
    public function messages()
    {
        return [
            'date_expired.after' => "The selected date and time must start from the current time"
        ];
    }
}
