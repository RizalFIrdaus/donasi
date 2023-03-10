<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StepTwoRequest extends FormRequest
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
            "user_phone" => "required",
            "patient_name" => "required|string|min:3|max:42",
            "patient_diagnose" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            'user_phone.required' => 'Nomor telepon wajib diisi.',
            'patient_name.required' => 'Nama pasien wajib diisi.',
            'patient_name.string' => 'Nama pasien harus berupa string.',
            'patient_name.min' => 'Nama pasien minimal 3 karakter.',
            'patient_name.max' => 'Nama pasien maksimal 42 karakter.',
            'patient_diagnose.required' => 'Diagnosa pasien wajib diisi.'
        ];
    }
}
