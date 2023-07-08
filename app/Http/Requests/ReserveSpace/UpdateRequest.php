<?php

namespace App\Http\Requests\ReserveSpace;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'room' => ['required'],
            'date' => ['required'],
            'count' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'room.required' => '部屋タイプは必ず入力して下さい。',
            'date.required' => '日付は必ず入力して下さい。',
            'count.required' => '予約枠解放数は必ず入力して下さい。',
        ];
    }
}
