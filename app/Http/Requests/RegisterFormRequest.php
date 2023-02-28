<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|min:6|max:24|string",
            "email" => "required|email",
            "password" => Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
        ];
    }
    public function messages(): array
    {
        return [
            "name.required" => "masukan nama kamu",
            "name.min" => "minimal 6 huruf",
            "name.max" => "maksimal 24 huruf",
            "name.string" => "harus berupa huruf",
            "email.required" => "masukan email kamu",
            "email.email" => "masukan email kamu dengan benar",
            'password.string' => 'Password harus berupa huruf',
            'password.min' => 'Password harus memiliki setidaknya 8 karakter',
            'password.letters' => 'Password harus mengandung setidaknya satu huruf',
            'password.mixed_case' => 'Password harus mengandung setidaknya satu huruf besar dan satu huruf kecil',
            'password.numbers' => 'Password harus mengandung setidaknya satu angka',
            'password.symbols' => 'Password harus mengandung setidaknya satu simbol',

        ];
    }
}
