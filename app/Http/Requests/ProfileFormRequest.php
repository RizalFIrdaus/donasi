<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileFormRequest extends FormRequest
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
            "fullname" => "required|string",
            "gender" => "required",
            "birthday" => "required|date",
            "number_phone" => "required|numeric",
            "address" => "required",
            "description" => "required"
        ];
    }
    public function messages(): array
    {
        return [
            "fullname.required" => "Kolom nama lengkap wajib diisi.",
            "fullname.string" => "Kolom nama lengkap hanya dapat diisi dengan huruf.",
            "gender.required" => "Kolom jenis kelamin wajib diisi.",
            "birthday.required" => "Kolom tanggal lahir wajib diisi.",
            "birthday.date" => "Kolom tanggal lahir harus dalam format tanggal yang benar.",
            "number_phone.required" => "Kolom nomor telepon wajib diisi.",
            "number_phone.numeric" => "Kolom nomor telepon hanya dapat diisi dengan angka.",
            "address.required" => "Kolom alamat wajib diisi.",
            "description.required" => "Kolom deskripsi wajib diisi."
        ];
    }
}
