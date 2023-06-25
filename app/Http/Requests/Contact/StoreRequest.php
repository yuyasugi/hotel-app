<?php

namespace App\Http\Requests\Contact;

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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50'],
            'phone_number' => ['required', 'string', 'max:20', 'regex:/^[0-9-]+$/'],
            'content' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必ず入力して下さい。',
            'email.required' => 'メールアドレスは必ず入力して下さい。',
            'phone_number.required' => '電話番号は必ず入力して下さい。',
            'content.required' => 'お問い合わせ内容が必要です。',
        ];
    }
}
