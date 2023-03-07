<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class PasswordFormRequest extends FormRequest
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
        $passwordRules = ["required", Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()];

        return [
            "old_password" => $passwordRules,
            "new_password" => $passwordRules,
            "renew_password" => $passwordRules
        ];
    }

    public function messages(): array
    {
        return [
            "old_password.required" => "Kolom kata sandi lama harus diisi",
            "new_password.required" => "Kolom kata sandi baru harus diisi",
            "renew_password.required" => "Kolom konfirmasi kata sandi baru harus diisi",
            "old_password.min" => "Kata sandi lama minimal 8 karakter",
            "new_password.min" => "Kata sandi baru minimal 8 karakter",
            "new_password.letters" => "Kata sandi baru harus mengandung huruf",
            "new_password.mixed_case" => "Kata sandi baru harus mengandung huruf kapital dan kecil",
            "new_password.numbers" => "Kata sandi baru harus mengandung angka",
            "new_password.symbols" => "Kata sandi baru harus mengandung simbol"
        ];
    }
}
