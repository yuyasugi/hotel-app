<?php

namespace App\Http\Requests\Plan;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'content' => ['required'],
            'cheapest_price' => ['required', 'numeric'],
            'highest_price' => ['required', 'numeric'],
            'meal' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'タイトルは必ず入力して下さい。',
            'content.required' => '内容は必ず入力して下さい。',
            'cheapest_price.required' => '最安値は必ず入力して下さい。',
            'highest_price.required' => '最高値は必ず入力して下さい。',
            'meal.required' => '食事は必ず入力して下さい。',
        ];
    }
}
